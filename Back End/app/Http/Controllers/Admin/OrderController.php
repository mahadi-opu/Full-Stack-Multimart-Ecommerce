<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sell;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Array_;

class OrderController extends Controller
{
    public function orderAll(Request $request)
    {
        $common_data = new Array_();
        $common_data->title = 'All Order';
    }

    public function orderPending(Request $request)
    {
        $common_data = new Array_();
        $common_data->title = 'Pending Order';
        $orderList = Sell::where(['sell_type' => 2, 'order_status' => 0, 'deleted' => 0])->get();
        return view('adminPanel.order.pending_order')->with(compact('orderList', 'common_data'));

    }

    public function orderProcessing(Request $request)
    {
        $common_data = new Array_();
        $common_data->title = 'Processing Order';
        $orderList = Sell::where(['sell_type' => 2, 'order_status' => 1, 'deleted' => 0])->get();

        return view('adminPanel.order.pending_order')->with(compact('orderList', 'common_data'));

    }

    public function orderOnTheWay(Request $request)
    {
        $common_data = new Array_();
        $common_data->title = 'Order On The Way ';
        $orderList = Sell::where(['sell_type' => 2, 'order_status' => 2, 'deleted' => 0])->get();
        return view('adminPanel.order.pending_order')->with(compact('orderList', 'common_data'));

    }

    public function orderCancelRequest(Request $request)
    {
        $common_data = new Array_();
        $common_data->title = 'Order Canceled Request';
        $orderList = Sell::where(['sell_type' => 2, 'order_status' => 3, 'deleted' => 0])->get();
        return view('adminPanel.order.pending_order')->with(compact('orderList', 'common_data'));
    }

    public function orderCancelAccept(Request $request)
    {
        $common_data = new Array_();
        $common_data->title = 'Order Canceled Accepted';
        $orderList = Sell::where(['sell_type' => 2, 'order_status' => 4, 'deleted' => 0])->get();
        return view('adminPanel.order.pending_order')->with(compact('orderList', 'common_data'));
    }

    public function orderCancelCompleted(Request $request)
    {
        $common_data = new Array_();
        $common_data->title = 'Canceled Process Completed';
        $orderList = Sell::where(['sell_type' => 2, 'order_status' => 5, 'deleted' => 0])->get();
        return view('adminPanel.order.pending_order')->with(compact('orderList', 'common_data'));
    }


    public function OrderComplete(Request $request)
    {
        $common_data = new Array_();
        $common_data->title = 'Completed Order';
        $common_data = new Array_();
        $orderList = Sell::where(['sell_type' => 2, 'order_status' => 6, 'deleted' => 0])->get();
        return view('adminPanel.order.pending_order')->with(compact('orderList', 'common_data'));

    }

    public function SellOrderDetails(Request $request)
    {
        $orderList = Sell::with('customer')
            ->with('sellDetail')
            ->with('orderAddress')
            ->with('paymentInfo')
            ->find($request->id);
        return view('adminPanel.order._order_details')->with(compact('orderList'))->render();
    }

    public function OrderStatusUpdate(Request $request)
    {
        $info = Sell::where('id', $request->order_id)->update(['order_status' => $request->status]);
        return redirect()->back()->with('success', 'Successfully Order Status Updated');
    }
}

