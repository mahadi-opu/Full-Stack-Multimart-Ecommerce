<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Image;

class BrandController extends Controller
{
    public function brandShow(){
        $brandList=Brand::get();
        return view('adminPanel.brand.brand')->with(compact('brandList'));
    }
    public function brandStore(Request $request){
        $brand=new Brand();
        $brand->name=$request->brand;
        $brand->image = $this->brandIcon($request->banner_img);
        $brand->save();

        return redirect()->back()->with('success', 'Product Brand Successfully Created');
    }



    public function brandUpdate(Request $request){

        $brand=Brand::find($request->id);
        $brand->name=$request->name;
        if($request->updateImage){
            $brand->image = $this->brandIcon($request->updateImage);
        }
        $brand->save();
        return redirect()->back()->with('success', 'Product Brand Successfully Updated');
    }

    public function brandIcon($image)
    {
        if (isset($image) && ($image != '') && ($image != null)) {
            $ext = explode('/', mime_content_type($image))[1];

            $logo_url = "brand_icons-" . time() . rand(1000, 9999) . '.' . $ext;
            $logo_directory = getUploadPath() . '/brand_icons/';
            $filePath = $logo_directory;
            $logo_path = $filePath . $logo_url;
            $db_media_img_path = 'storage/brand_icons/' . $logo_url;

            if (!file_exists($filePath)) {
                mkdir($filePath, 666, true);
            }

            $logo_image = Image::make(file_get_contents($image))->resize(200, 200);
            $logo_image->brightness(8);
            $logo_image->contrast(11);
            $logo_image->sharpen(5);
            $logo_image->encode('webp', 70);
            $logo_image->save($logo_path);

            return $db_media_img_path;

        }

    }
}
