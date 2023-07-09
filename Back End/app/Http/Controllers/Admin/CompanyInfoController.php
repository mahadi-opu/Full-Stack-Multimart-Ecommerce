<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyInfo;
use Illuminate\Http\Request;
use Image;
use PhpParser\Node\Expr\Array_;

class CompanyInfoController extends Controller
{
    public function companyDetails(){
        $common_data = new Array_();
        $common_data->title = 'Company Details';
        $companyInfo=CompanyInfo::first();
        return view('adminPanel.company_info.company_info')->with(compact('common_data','companyInfo'));

    }
    public function CompanyInfo(Request $request){
        $mainimg=$request->company_logo;
        $getinfo= CompanyInfo::where('id',1)->first();
       if($getinfo){
           $companyInfo=$getinfo;
       }else{
           $companyInfo=new CompanyInfo();
       }
        $companyInfo->name=$request->name;
        $companyInfo->email=$request->email;
        $companyInfo->phone=$request->phone;

        if (str_contains($mainimg, 'storage/company_logo')) {
            $companyInfo->company_logo=$request->company_logo;
        } else {
            if (isset($mainimg) && ($mainimg != '') && ($mainimg != null)) {
                $companyInfo->company_logo=$this->logo($mainimg);
            }
        }
        $companyInfo->facebook_link=$request->facebook_link;
        $companyInfo->youtube_link=$request->youtube_link;
        $companyInfo->twitter_link=$request->twitter_link;
        $companyInfo->company_address=$request->company_address;
        $companyInfo->about_us=$request->about_us;
        $companyInfo->refund_policy=$request->refund_policy;
        $companyInfo->shipping_policy=$request->shipping_policy;
        $companyInfo->privacy_policy=$request->privacy_policy;
        $companyInfo->terms_condition=$request->terms_condition;
        $companyInfo->save();

        return redirect()->back()->with('success','Successfully Updated ');
    }
    public function logo($image)
    {
        if (isset($image) && ($image != '') && ($image != null)) {
            $ext = explode('/', mime_content_type($image))[1];

            $logo_url = "company_logo-" . time() . rand(1000, 9999) . '.' . $ext;
            $logo_directory = getUploadPath() . '/company_logo/';
            $filePath = $logo_directory;
            $logo_path = $filePath . $logo_url;
            $db_media_img_path = 'storage/company_logo/'.$logo_url;
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
