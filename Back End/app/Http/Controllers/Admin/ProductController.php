<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Models\ProductSize;
use App\Models\ProductSubCategory;
use App\Models\Sell;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;
use PhpParser\Node\Expr\Array_;
use PDF;

class ProductController extends Controller
{
    public function productList()
    {
        $common_data = new Array_();
        $common_data->title = 'Product List';

        $productList = Product::where('deleted', 0)->get();
        $productCategory = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        $supplierList = Supplier::where('status', 1)->where('deleted', 0)->get();
        return view('adminPanel.product.product_list')->with(compact('common_data', 'productList', 'productCategory', 'supplierList'));
    }

    public function createProduct(Request $request)
    {

        $common_data = new Array_();
        $common_data->title = 'Add Product';
        $productCategory = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        $supplierList = Supplier::where('status', 1)->where('deleted', 0)->get();
        $brand=Brand::get();
        $color=ProductColor::get();
        $size=ProductSize::get();
        return view('adminPanel.product.create_product')->with(compact('productCategory', 'supplierList', 'common_data','brand','color','size'));

    }

    public function productSizeUpdate(Request $request){
        $productSize= ProductSize::find($request->id);
        $productSize->size=$request->size;
        $productSize->save();
        return redirect()->back()->with('success', 'Product Size Successfully Updated');

    }
    public function productColorUpdate(Request $request){
        $productColor= ProductColor::find($request->id);
        $productColor->name=$request->name;
        $productColor->color_code=$request->color_code;
        $productColor->save();
        return redirect()->back()->with('success', 'Product Size Successfully Updated');

    }

    public function productColor(){
        $common_data = new Array_();
        $common_data->title = 'Add Color';
        $productColor=ProductColor::get();
        return view('adminPanel.product_color.product_color_list')->with(compact("common_data",'productColor'));
    }

    public function productColorStore(Request $request){
        $productcolor=new ProductColor();
        $productcolor->name=$request->name;
        $productcolor->color_code=$request->color_code;
        $productcolor->save();
        return redirect()->back()->with('success', 'Product Color Successfully Created');
    }

    public function productSize(){
        $common_data = new Array_();
        $common_data->title = 'Add Size';
        $productSize=ProductSize::get();
        return view('adminPanel.product_size.product_size')->with(compact("common_data",'productSize'));;
    }
     public function productSizeStore(Request $request){
        $sizelist=  explode(",",$request->size);
        foreach ($sizelist as $size){

            $productsize=new ProductSize();
            $productsize->size=$size;
            $productsize->save();
        }
         return redirect()->back()->with('success', 'Product Size Successfully Created');
     }
    public function storeProduct(Request $request)
    {

        $image = $request->product_img[0];
        $product = new Product();
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->image_path = $request->image_path;
        $product->color = implode(",", $request->color);
        $product->size = implode(",", $request->size);
        $product->brand_id = $request->brand_id;
        $product->supplier_id = $request->supplier_id;
        $product->current_purchase_cost = $request->current_purchase_cost;
        $product->current_sale_price = $request->current_sale_price;
        $product->current_wholesale_price = $request->current_wholesale_price;
        $product->wholesale_minimum_qty = $request->wholesale_minimum_qty;
        $product->discount_type = $request->discount_type;
        $product->discount = $request->discount;
        $product->unit_type = $request->unit_type;
        $product->description = $request->description;
        if ($request->is_popular) {
            $product->is_popular = 1;
        }
        if ($request->is_trending) {
            $product->is_trending = 1;
        }

        if (isset($image) && ($image != '') && ($image != null)) {
            $product->image_path = $this->productImageSave($image);
        }

        $product->created_at = Carbon::now();
        $product->save();
        $lastProductId = Product::orderBy('id', 'desc')->first()->id;
        $product->code = 1000 + $lastProductId;
        $product->save();


        foreach ($request->product_img as $key => $imagedata) {
            if ($key != 0) {
                $productImage = new ProductImage();
                $productImage->product_id = $product->id;
                $image = $imagedata;
                if (isset($image) && ($image != '') && ($image != null)) {
                    $productImage->image = $this->productImageSave($image);
                    $productImage->save();
                }
            }
        }
        return redirect()->back()->with('success', 'Product Successfully Created');
    }

    public function productEditDetails(Request $request)
    {
        $productInfo = Product::find($request->product_id);
        $productCategory = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        $productSubcategory = ProductSubCategory::where('category_id', $productInfo->category_id)->where('status', 1)->where('deleted', 0)->get();
        $supplierList = Supplier::where('status', 1)->where('deleted', 0)->get();
        $brand=Brand::get();
        $color=ProductColor::get();
        $size=ProductSize::get();
        return view('adminPanel.product._edit_product')->with(compact('productInfo', 'supplierList', 'productCategory', 'productSubcategory', 'supplierList','brand','color','size'))->render();
    }

    public function imageDelete(Request $request)
    {

        ProductImage::where('id', $request->id)->delete();
        return 'success';
    }

    public function productUpdate(Request $request)
    {

        $mainimg = $request->main_image;

        $product = Product::find($request->product_id);
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->image_path = $request->image_path;
        $product->brand_id = $request->brand_id;
        $product->color = implode(",", $request->product_color);
        $product->size = $request->size;
        $product->supplier_id = $request->supplier_id;
        $product->current_purchase_cost = $request->current_purchase_cost;
        $product->current_sale_price = $request->current_sale_price;
        $product->current_wholesale_price = $request->current_wholesale_price;
        $product->wholesale_minimum_qty = $request->wholesale_minimum_qty;
        $product->discount_type = $request->discount_type;
        $product->discount = $request->discount;
        $product->unit_type = $request->unit_type;
        $product->description = $request->description;
        if ($request->is_popular) {
            $product->is_popular = 1;
        } else {
            $product->is_popular = 0;
        }
        if ($request->is_trending) {
            $product->is_trending = 1;
        } else {
            $product->is_popular = 0;
        }
        if (str_contains($mainimg, 'storage/product_images')) {
            $product->image_path = $mainimg;
        } else {
            if (isset($mainimg) && ($mainimg != '') && ($mainimg != null)) {
                $product->image_path = $this->productImageSave($mainimg);
            }
        }
        $product->updated_at = Carbon::now();
        $product->save();

        if (isset($request->editImage)) {
            foreach ($request->editImage as $key => $image2) {

                if ($request->editImage[$key][0]) {
                    $image2 = $request->editImage[$key][0];
                    if (isset($image2) && ($image2 != '') && ($image2 != null)) {
                        $imageurl = $this->productImageSave($image2);
                        $productImage = ProductImage::find($key);
                        $productImage->image = $imageurl;
                        $productImage->save();
                    }
                }
            }
        }

        if (isset($request->new_product_img)) {
            foreach ($request->new_product_img as $key => $image) {
                if (isset($image) && ($image != '') && ($image != null)) {
                    $newProductImage = new ProductImage();
                    $newProductImage->product_id = $request->product_id;
                    $newProductImage->image = $this->productImageSave($image);
                    $newProductImage->save();
                }
            }
        }

        return redirect()->back()->with('success', 'Product updated successfully');
    }

    public function productImageSave($image)
    {
        if (isset($image) && ($image != '') && ($image != null)) {
            $ext = explode('/', mime_content_type($image))[1];

            $logo_url = "product_images-" . time() . rand(1000, 9999) . '.' . $ext;
            $logo_directory = getUploadPath() . '/product_images/';
            $filePath = $logo_directory;
            $logo_path = $filePath . $logo_url;
            $db_media_img_path = 'storage/product_images/' . $logo_url;

            if (!file_exists($filePath)) {
                mkdir($filePath, 666, true);
            }
            $logo_image = Image::make(file_get_contents($image))->resize(400, 400);
            $logo_image->brightness(8);
            $logo_image->contrast(11);
            $logo_image->sharpen(5);
            $logo_image->encode('webp', 70);
            $logo_image->save($logo_path);

            return $db_media_img_path;

        }

    }

    public function productBarcodeGenerate(Request $request)
    {
        $product = Product::find($request->product_id);

        $data = [
            'product' => $product,
            'qty' => $request->barcode_qty,
        ];

        $pdf = PDF::loadView('adminPanel.product.barcode_generate', $data);
//      return view('adminPanel.pos.sell_invoice');
//      return $pdf->download('buy_invoice.pdf');
        return $pdf->stream('buy_invoice.pdf');

    }
}
