<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeaturedLink;
use Illuminate\Http\Request;
use Image;

class FeaturedLinkController extends Controller
{
    public function featuredLinkList(){
        $featuredImage=FeaturedLink::get();
        return view('adminPanel.featured_link.featured_link_list')->with(compact('featuredImage'));
    }
    public function featuredLinkStore(Request $request){

        $feature=new FeaturedLink();
        $feature->title=$request->title;
        $feature->link=$request->featured_link;
        $feature->image= $this->banner($request->banner_img);
        if($request->is_active){
            $feature->is_active=1 ;
        }else{
            $feature->is_active=0;
        }
        $feature->save();
        return redirect()->back()->with('success', 'Featured link  successfully created');

    }

    public function featuredLinkUpdate(Request $request){
        $feature=FeaturedLink::find($request->id);
        $feature->title=$request->title;
        $feature->link=$request->featured_link;
        if($request->updateImage){
            $feature->image= $this->banner($request->updateImage);
        }
        if($request->is_active){
            $feature->is_active=1 ;
        }else{
            $feature->is_active=0;
        }
        $feature->save();
        return redirect()->back()->with('success', 'Featured link  successfully updated');
    }


    public function banner($image)
    {
        if (isset($image) && ($image != '') && ($image != null)) {
            $ext = explode('/', mime_content_type($image))[1];

            $logo_url = "featured_icons-" . time() . rand(1000, 9999) . '.' . $ext;
            $logo_directory = getUploadPath() . '/featured_icons/';
            $filePath = $logo_directory;
            $logo_path = $filePath . $logo_url;
            $db_media_img_path = 'storage/featured_icons/' . $logo_url;

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
