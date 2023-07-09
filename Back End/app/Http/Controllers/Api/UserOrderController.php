<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserOrderDetailsResource;
use App\Http\Resources\UserOrderListResource;
use App\Models\Sell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserOrderController extends Controller
{
    public function orderList(){
      return $orderList= UserOrderListResource::collection(Sell::where('sell_type',2)->where('customer_id',Auth::user()->id)->orderBy('id','desc')->paginate(10));
    }

    public function orderDetails(Request $request){
        return UserOrderDetailsResource::collection(Sell::where('id',$request->id)->get());
    }

    public function cancel(Request $request){
      $data= Sell::where('id',$request->order_id)->update(['order_status'=>3]);
      if($data){
          return response()->json(['status' => 200,'msg'=>'Address created successfully']);
      }
    }
}
