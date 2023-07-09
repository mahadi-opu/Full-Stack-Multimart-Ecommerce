<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BankAccount;
use App\Models\PosCustomer;
use App\Models\Product;
use App\Models\Purchase_product_list;
use App\Models\PurchaseDetails;
use App\Models\PurchaseProductList;
use App\Models\Supplier;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Array_;

class PurchaseController extends Controller
{
    public function purchaseProductView()
    {
        $common_data = new Array_();
        $common_data->title = 'Product Purchase';
        $productList = Product::where('status', 1)->where('deleted', 0)->paginate(12);
        $supplierList = Supplier::where('status', 1)->where('deleted', 0)->get();
        $bankList = BankAccount::where('status', 1)->where('deleted', 0)->get();

        return view('adminPanel.product_stock.purchase_product')->with(compact('supplierList', 'bankList', 'common_data'));
    }

    public function purchaseList(){
        $common_data = new Array_();
        $common_data->title = 'Product Purchase';
        $purchaseList=PurchaseProductList::orderBy('date','desc')->get();
        return view('adminpanel.product_stock.purchase_list')->with(compact('purchaseList'));
    }

    public function purchasePaymentStore(Request $request)
    {
        $purchase = new PurchaseProductList();
        $purchase->total_cost = $request->total_payable;
        $purchase->total_payable_amount = $request->total_paid;
        $purchase->total_paid = $request->total_paid;
        $purchase->total_vat = 0;
        $purchase->total_discount = $request->totalDiscount;
        $purchase->total_due = $request->total_payable - $request->total_paid;
        $purchase->supplier_id = $request->supplier_id;
        $purchase->date = Carbon::now();
        $purchase->save();
        $purchase->purchase_code=1000+$purchase->id;
        $purchase->save();
        foreach ($request->product_id as $key => $product) {
            $productId=$request->product_id[$key];
            $productdata=Product::find($productId)->first();
            $availableProduct=$productdata->available_quantity;
            $qty=$request->sell_qty[$key];
            $totalProduct=$availableProduct+$qty;
            $payable = $request->unit_cost[$key] * $request->sell_qty[$key];
            $purchaseProduct = new PurchaseDetails();
            $purchaseProduct->purchase_id = $purchase->id;
            $purchaseProduct->product_id = $request->product_id[$key];
            $purchaseProduct->purchase_payable_amount = $payable;
            $purchaseProduct->unit_cost =$request->unit_cost[$key];
            $purchaseProduct->total_qty =$qty;
            $purchaseProduct->total_cost =$payable;
            $purchaseProduct->total_vat =0;
            $purchaseProduct->date = Carbon::now();
            $purchaseProduct->total_discount =0;
            $purchaseProduct->save();
        }
        foreach ($request->product_id as $key => $product_id) {
            $product=Product::where('id',$product_id)->first();
            $availableProduct=$product->available_quantity;
            $qty=$request->sell_qty[$key];
            $total_qty=$availableProduct+$qty;
            Product::where('id',$product_id)->update(['available_quantity'=>$total_qty]);
        }



           return  redirect()->back()->with('success','Successfully Product Purchase');
    }

    public function purchaseInvoice(Request $request)
    {
//        return $request->id;
          $purchaseInfo = PurchaseProductList::with('purchaseInfo')->where('id',$request->id)->first();
          $purchaseDetails=PurchaseDetails::with('productInfo')->where('purchase_id',$request->id)->get();


//        return $purchaseInfo->purchaseDetails;


//        supplierInfo
//purchaseDetails
//ProductInfo

        $data = [
            'purchase' => $purchaseInfo,
            'purchaseDetails'=>$purchaseDetails,
        ];

        $pdf = PDF::loadView('adminPanel.product_stock.purchase_invoice', $data);
//      return view('adminPanel.pos.sell_invoice');
//      return $pdf->download('buy_invoice.pdf');
        return $pdf->stream('Purchase_invoice.pdf');

    }
}
