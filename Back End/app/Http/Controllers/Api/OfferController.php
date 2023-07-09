<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OfferProductResource;
use App\Http\Resources\ProductResource;
use App\Models\Offer;
use App\Models\Offer_product_list;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function offerBanner()
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $offerlist = Offer::where('start_date', '<=', $currentDate)
            ->where('end_date', '>=', $currentDate)
            ->get();
        return response()->json($offerlist, 200);
    }
    public function offerProduct(Request $request)
    {
        $offer_id = $request->offer_id;
        $subcategory_id = $request->subcategory_id;
        return OfferProductResource::collection(Offer_product_list::where('offer_id', $offer_id)
        ->with('productInfo')
            ->whereHas('productInfo',function($q) use($subcategory_id){
                return $q->when($subcategory_id!='All',function($q) use($subcategory_id){
                    return $q->where('products.subcategory_id',$subcategory_id);
                });
            })
        ->paginate(20));
    }
}
