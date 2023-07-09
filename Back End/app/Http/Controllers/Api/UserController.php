<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserShippingBillingAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function userAddress(Request $request)
    {
        $userinfo=UserShippingBillingAddress::where('user_id',Auth::user()->id)->first();
        $edit=false;
        $create=false;
        if($userinfo){
            $userinfo=UserShippingBillingAddress::find($userinfo->id);
            $userinfo->email=$request->shipping_email;
            $userinfo->first_name=$request->shipping_first_name;
            $userinfo->last_name=$request->shipping_last_name;
            $userinfo->shipping_address=$request->shipping_address;
            $userinfo->shipping_city=$request->shipping_city;
            $userinfo->shipping_country=$request->shipping_country;
            $userinfo->shipping_zip=$request->shipping_zip;
            $userinfo->shipping_phone=$request->shipping_phone;
            $userinfo->shipping_state=$request->shipping_state;
            $userinfo->shipping_division=$request->shipping_division;
            $userinfo->shipping_district=$request->shipping_district;



            $userinfo->billing_address=$request->billing_address;
            $userinfo->billing_city=$request->billing_city ;
            $userinfo->billing_country=$request->billing_country;
            $userinfo->billing_zip=$request->billing_zip;
            $userinfo->billing_state=$request->billing_state;
            $userinfo->billing_first_name=$request->billing_first_name;
            $userinfo->billing_last_name=$request->billing_last_name;
            $userinfo->billing_email=$request->billing_email;
            $userinfo->billing_phone=$request->billing_phone;


            $userinfo->billing_division=$request->billing_division;
            $userinfo->billing_district=$request->billing_district;


            $edit=$userinfo->save();
        }
        else{
            $useraddress=new UserShippingBillingAddress();
            $useraddress->user_id=Auth::user()->id;
            $useraddress->email=$request->shipping_email;
            $useraddress->first_name=$request->shipping_first_name;
            $useraddress->last_name=$request->shipping_last_name;
            $useraddress->shipping_phone=$request->shipping_phone;
            $useraddress->shipping_address=$request->shipping_address;
            $useraddress->shipping_city=$request->shipping_city;
            $useraddress->shipping_country=$request->shipping_country;
            $useraddress->shipping_zip=$request->shipping_zip;
            $useraddress->shipping_state=$request->shipping_state;
            $useraddress->billing_address=$request->billing_address;
            $useraddress->billing_city=$request->billing_city;
            $useraddress->billing_country=$request->billing_country;
            $useraddress->billing_zip=$request->billing_zip;
            $useraddress->billing_state=$request->billing_state;
            $useraddress->billing_first_name=$request->billing_first_name;
            $useraddress->billing_last_name=$request->billing_last_name;
            $useraddress->billing_email=$request->billing_email;
            $useraddress->billing_phone=$request->billing_phone;
            $create=$useraddress->save();
        }

        if($edit){
            return response()->json(['status' => 200,'msg'=>'Address edited successfully']);
        }
        if($create){
            return response()->json(['status' => 200,'msg'=>'Address created successfully']);
        }
    }
    function userAddressGet(){
        $userinfo=UserShippingBillingAddress::where('user_id',Auth::user()->id)->first();
        $userInfo=['status' => 200,'data'=>$userinfo];
        return response()->json($userInfo);
    }

}
