<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Array_;
use Image;

class ProductCategoryController extends Controller
{
    public function productCategory()
    {
        $common_data = new Array_();
        $common_data->title = 'Product Category';
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        return view('adminPanel.product_category.product_category')->with(compact('category','common_data'));
    }

    public function productCategoryStore(Request $request)
    {
        $category = new ProductCategory();
        $category->name = $request->name;
        $category->note = $request->note;
        $category->image = $this->categoryIcon($request->banner_img);
        $category->created_at = Carbon::now();
        $category->save();
        return redirect()->back()->with('success', 'Successfully Added Category');
    }

    public function productCategoryUpdate(Request $request)
    {

        $subcategory = ProductCategory::find($request->category_id);
        $subcategory->name = $request->name;
        $subcategory->note = $request->note;
        if($request->updateImage){
            $subcategory->image = $this->categoryIcon($request->updateImage);
        }
        if($request->is_popular){
            $subcategory->is_popular = 1;
        }else{
            $subcategory->is_popular = 0;
        }
        $subcategory->save();
        return redirect()->back()->with('success', 'Category Successfully Updated');

    }
    public function productCategoryDelete(Request $request){
        $subcategory = ProductSubCategory::find($request->id);
        $subcategory->deleted=1;
        $subcategory->save();
        return redirect()->back()->with('success', 'Subcategory Successfully Deleted');
    }


    public function categoryIcon($image)
    {
        if (isset($image) && ($image != '') && ($image != null)) {
            $ext = explode('/', mime_content_type($image))[1];

            $logo_url = "category_icons-" . time() . rand(1000, 9999) . '.' . $ext;
            $logo_directory = getUploadPath() . '/category_icons/';
            $filePath = $logo_directory;
            $logo_path = $filePath . $logo_url;
            $db_media_img_path = 'storage/category_icons/' . $logo_url;

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
}
