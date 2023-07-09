<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\Offer;
use App\Models\Offer_product_list;
use App\Models\PaymentInfo;
use App\Models\Product;
use App\Models\Sell;
use App\Models\Sell_details;
use App\Models\SellOrderAddress;
use App\Models\ShippingAddress;
use App\Models\ShippingInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Stripe;
use Stripe\PaymentIntent;


class StripePaymentController extends Controller
{
    public function stripePayment(Request $request)
    {
        $cardInfo = $request->payment_info['paymentMethod']['card'];
        $shippingInfo = $request->shipping_info;
        $order_items = $request->order_item;
        $total_payable = 0;
        $discountTotal = 0;
        $shippingCost = $request->shippingCost;
        $orderCalculate = calculateOrder($order_items);
        $total_payable = $orderCalculate[0] + $shippingCost;
        $discountTotal = $orderCalculate[1];
        DB::beginTransaction();

        try {
            $sell = new Sell();
            $sell->total_payable_amount = $total_payable;
            $sell->total_discount = $discountTotal;
            $sell->total_paid = 0;
            $sell->total_due = $total_payable;
            $sell->customer_id = Auth::user()->id;
            $sell->bank_id = 1;
            $sell->sell_type = 2;
            $sell->shipping_cost = $shippingCost;
            $sell->sell_by = 1;
            $sell->order_status = 0;
            $sell->payment_type = 1;
            $sell->date = Carbon::now();
            $sell->created_at = Carbon::now();
            $sell->save();
            $sell->invoice_id = 1000 + $sell->id;
            $sell->save();


            foreach ($order_items as $item) {
                $product = Product::find($item['id']);
                $discount = calculateDiscount($item);
                $unitPrice = $product->current_sale_price - $discount;
                if ($unitPrice != $item['price']) {
                    Sell::where('id', $sell->id)->delete();
                    $msg = [
                        'status' => 331,
                        'msg' => $item['productName'] . ' This product offer period has expired Please add this product to the cart again',
                        'name' => $item['productName'],
                        'id' => $item['id'],
                    ];
                    DB::commit();
                    $product = Product::find($item['id']);
                    DB::rollBack();
                    return response()->json($msg);
                }

                $quantity = $item['quantity'];
                $total_price = $quantity * $unitPrice;
                $total_discount = $discount * $quantity;

                $productSell = new Sell_details();
                $productSell->sell_id = $sell->id;
                $productSell->product_id = $item['id'];
                $productSell->total_discount = $total_discount;
                $productSell->sale_quantity = $quantity;
                $productSell->unit_product_cost = $product->current_purchase_cost;
                $productSell->unit_sell_price = $product->current_sale_price;
                $productSell->total_payable_amount = $total_price;
                $productSell->save();
            }

            foreach ($order_items as $item) {
                $product = Product::find($item['id']);
                $availableProduct = $product->available_quantity;
                $qty = $item['quantity'];
                $total_qty = $availableProduct - $qty;
                Product::where('id', $item['id'])->update(['available_quantity' => $total_qty]);
            }


            //stripe pay
            $payment_method_id = $request->payment_info['paymentMethod']['id'];

            Stripe\Stripe::setApiKey('sk_test_51MyBGiE9CkClsfMvrRd6Dwye9nJpgtsR5Mw2fQABvGzZGX9L6jC9KJVFEywlGthv4dAA1iZAKCBtMxfOXO6jsTVa00oa5RkXDv');


            if ($total_payable != $request->total_payable) {
                $msg = [
                    'status' => 400,
                    'msg' => 'Payable amount  is incorrect, Please add to card again ',
                ];
                DB::rollBack();
                return response()->json($msg);
            }
            $payment = PaymentIntent::create([
                'amount' => $total_payable * 100,
                'currency' => 'usd',
                'payment_method' => $payment_method_id, // replace with your actual payment method ID
                'confirm' => true,
            ]);

            $payInfo = new PaymentInfo();
            $payInfo->payment_type = 'stripe';
            $payInfo->sell_id = $sell->id;
            $payInfo->total_paid = $payment->amount / 100;
            $payInfo->tnx_id = $payment->id;
            $payInfo->card_brand = $cardInfo['brand'];
            $payInfo->card_last_digit = $cardInfo['last4'];
            $payInfo->created_at = Carbon::now();
            $payInfo->save();
            $sell->total_paid = $payment->amount / 100;
            $sell->total_due = 0;
            $sell->save();

            $city = $shippingInfo['city'];
            $country = $shippingInfo['country'];
            $post_code = $shippingInfo['postal_code'];
            $email = $shippingInfo['email'];
            $name = $shippingInfo['name'];
            $phone = $shippingInfo['phone'];
            $address = $shippingInfo['address'];
            $shipping_division = $shippingInfo['division'];
            $shipping_district = $shippingInfo['district'];


            $shippingInfo = new SellOrderAddress();
            $shippingInfo->email = $email;
            $shippingInfo->name = $name;
            $shippingInfo->sell_id = $sell->id;
            $shippingInfo->user_id = Auth::user()->id;
            $shippingInfo->shipping_phone = $phone;
            $shippingInfo->shipping_address = $address;
            $shippingInfo->shipping_city = $city;
            $shippingInfo->shipping_country = $country;
            $shippingInfo->shipping_zip = $post_code;

            $shippingInfo->shipping_division = $shipping_division;
            $shippingInfo->shipping_district = $shipping_district;
            $shippingInfo->save();

            $sell = Sell::find($sell->id)->with(['sellDetail', 'orderAddress', 'paymentInfo'])->first();
            $details = [
                'title' => 'Mail from ItSolutionStuff.com',
                'body' => 'This is for testing email using smtp',
                'data' => $sell,
            ];


            if ($shippingInfo['email']) {
                Mail::to($shippingInfo['email'])->send(new OrderMail($details));
            }

        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json('Internal error', 404);
        }

        $success = [
            'status' => 200,
            'msg' => 'Successfully payment completed',
        ];
        return response()->json($success);

    }
}
