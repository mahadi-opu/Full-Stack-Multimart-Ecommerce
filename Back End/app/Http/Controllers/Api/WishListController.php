<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WishListResource;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    public function addWishList(Request $request){

    $wishlist= new Wishlist();
    $wishlist->product_id=$request->product_id;
    $wishlist->user_id=Auth::user()->id;
    $wishlist->date=Carbon::now();
    $wishlist->save();
    $data=[
        'status'=>200,
         'msg'=>'WishList Added Successfully'
    ];

      return response()->json($data);
    }

    public function getWishList(){

        return WishListResource::collection(Wishlist::where('user_id',Auth::user()->id)->get());


    }

    public function count(){
        return Wishlist::where('user_id',Auth::user()->id)->count();
    }
}
