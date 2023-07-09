<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCategoryResource;
use App\Http\Resources\UserOrderListResource;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function categoryList(){
        $categorydata=UserOrderListResource::collection(ProductCategory::where('status',1)->where('deleted',0)->get());

        $categoryList=ProductCategoryResource::collection($categorydata);

            return response()->json($categoryList,200);
    }

    public function allCategorySubcategory(){

        $categorySubcategory=ProductCategoryResource::collection(ProductCategory::where('status',1)->where('deleted',0)->get());
        return response()->json($categorySubcategory,200);

    }

    public function popularCategory(){
        $popularCategory=ProductCategory::where('is_popular',1)->get();
        return response($popularCategory,200);
    }
}
