<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Supplier;
use App\Models\Supplier_list;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function supplierList()
    {
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        $suppliers = Supplier::where('deleted', 0)->get();
        return view('adminPanel.supplier.supplier_list')->with(compact('category', 'suppliers'));
    }

    public function supplierStore(Request $request)
    {
        $supplier = new Supplier();
        $supplier->supplier_name = $request->supplier_name;
//        $supplier->image=$request->image;
        $supplier->supplier_phone_one = $request->supplier_phone_one;
        $supplier->supplier_phone_two = $request->supplier_phone_two;
        $supplier->company_name = $request->company_name;
        $supplier->company_address = $request->company_address;
        $supplier->supplier_address = $request->supplier_address;
        $supplier->company_email = $request->company_email;
        $supplier->company_phone = $request->company_phone;
        $supplier->supplier_email = $request->supplier_email;
        $supplier->previous_due = $request->previous_due;
        $supplier->save();

        return redirect()->back()->with('success', 'Supplier Successfully Created');
    }
    public function supplierEditInfo(Request $request)
    {
        $supplierInfo = Supplier::find($request->id);

        return view('adminPanel.supplier._supplier_edit')->with(compact('supplierInfo'))->render();
    }
    public function supplierUpdate(Request $request)
    {
        $supplier = Supplier::find($request->supplier_id);
        $supplier->supplier_name = $request->supplier_name;
        $supplier->supplier_phone_one = $request->supplier_phone_one;
        $supplier->supplier_phone_two = $request->supplier_phone_two;
        $supplier->company_name = $request->company_name;
        $supplier->company_address = $request->company_address;
        $supplier->supplier_address = $request->supplier_address;
        $supplier->company_email = $request->company_email;
        $supplier->company_phone = $request->company_phone;
        $supplier->supplier_email = $request->supplier_email;
        $supplier->previous_due = $request->previous_due;
        $supplier->save();

        return redirect()->back()->with('success', 'Supplier Successfully upgrade');
    }
    public function purchaseSupplierStore(Request $request){
        $supplier = new Supplier();
        $supplier->supplier_name = $request->supplier_name;
        $supplier->supplier_phone_one = $request->supplier_phone_one;
        $supplier->supplier_phone_two = $request->supplier_phone_two;
        $supplier->company_name = $request->company_name;
        $supplier->company_address = $request->company_address;
        $supplier->supplier_address = $request->supplier_address;
        $supplier->company_email = $request->company_email;
        $supplier->company_phone = $request->company_phone;
        $supplier->supplier_email = $request->supplier_email;
        $supplier->previous_due = $request->previous_due;
        $supplier->save();
        $supplier_id=$supplier->id;
        $supplierList=Supplier::where('status', 1)->where('deleted', 0)->get();
        return view('adminPanel.supplier._supplier_list')->with(compact('supplier_id','supplierList'))->render();
    }
    public function purchaseItemGet(Request $request){
        $productinfo = Product::find($request->product_id);
        $discount = 0;
        if ($productinfo->discount_type == 0) {
            $discount = $productinfo->discount;
        }
        if ($productinfo->discount_type == 1) {
            $discount = ($productinfo->discount * $productinfo->current_sale_price / 100);
        }
        return view('adminPanel.product_stock._purchase_product_item')->with(compact('productinfo', 'discount'))->render();

    }

}
