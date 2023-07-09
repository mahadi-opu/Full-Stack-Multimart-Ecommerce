<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Array_;

class ProductSubcategoryController extends Controller
{
    public function productSubcategory()
    {
        $common_data = new Array_();
        $common_data->title = 'Product Subcategory';

        $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $productCategory = ProductCategory::where('deleted', 0)->where('status', 1)->get();

        return view('adminPanel.product_subcategory.product_subcategory')->with(compact('productSubcategory', 'productCategory','common_data'));
    }

    public function productSubCategoryStore(Request $request)
    {
        $subcategory = new ProductSubCategory();
        $subcategory->category_id = $request->category_id;
        $subcategory->name = $request->name;
        $subcategory->note = $request->note;
        $subcategory->created_at = Carbon::now();
        $subcategory->save();

        return redirect()->back()->with('success', 'Subcategory Successfully created');

    }

    public function productSubCategoryUpdate(Request $request)
    {
        $subcategory = ProductSubCategory::find($request->subcategory_id);
        $subcategory->category_id = $request->category_id;
        $subcategory->name = $request->name;
        $subcategory->note = $request->note;
        $subcategory->save();
        return redirect()->back()->with('success', 'Subcategory Successfully Updated');

    }
    public function productSubCategoryDelete(Request $request){
        $subcategory = ProductSubCategory::find($request->id);
        $subcategory->deleted=1;
        $subcategory->save();
        return redirect()->back()->with('success', 'Subcategory Successfully Deleted');
    }

    public function subcategoryListGet(Request $request){

        $subcategoryList=ProductSubCategory::where('category_id',$request->category_id)->where('status',1)->where('deleted',0)->get();
        return view('adminPanel.product_subcategory._subcategory_list')->with(compact('subcategoryList'))->render();
    }
}
