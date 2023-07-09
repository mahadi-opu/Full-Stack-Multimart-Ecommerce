<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\Currency;
use App\Models\Faq;
use App\Models\FeaturedLink;
use App\Models\ShippingCost;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function shippingCost(Request $request){
         $divisionId=$request['division_id'];
         $districtId=$request['district_id'];
         $shippingCost=0;
         $list=ShippingCost::where('division_id',$divisionId)->where('district_id',$districtId)->first();
         $shippingInfo=ShippingCost::first();
         if($list){
             $shippingCost=$shippingInfo->inside_price;
         }else{
             $shippingCost=$shippingInfo->outside_price;
         }
         return response()->json($shippingCost);
    }
    public function currency(){
        $currency=Currency::first();
        return response()->json($currency);
    }

    public function featuredList(){
        $link=FeaturedLink::where('is_active',1)->get()->take(3);
        return response()->json($link);
    }
    public function getFaq(){
        $faqData= Faq::get();
        return response()->json($faqData);
    }

    public function getAds(){
        $first= Ads::where('position',1)->orderBy('position','asc')->get();
        $second= Ads::Where('position',2)->orderBy('position','asc')->get();
        $list=[
            'first'=>$first,
            'second'=>$second,
        ];
        return response()->json($list);
    }
}
