<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductSubCategory;
use Illuminate\Http\Request;

class ProductSubcategoryController extends Controller
{
    public function categoryWiseSubcategory(Request $request){

        $subcategoryList= ProductSubCategory::where('category_id',$request->category_id)->where('deleted',0)->where('status',1)->select('id','name','category_id')->get();
            return response()->json($subcategoryList);

    }
    public function allSubcategory(){
        $subcategoryList= ProductSubCategory::where('deleted',0)->where('status',1)->select('id','name','category_id')->get();
        return response()->json($subcategoryList);
    }
}
