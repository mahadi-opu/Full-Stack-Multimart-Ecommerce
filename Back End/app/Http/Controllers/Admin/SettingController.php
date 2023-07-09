<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\Currency;
use App\Models\District;
use App\Models\Division;
use App\Models\Faq;
use App\Models\ShippingCost;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Array_;
use Image;

class SettingController extends Controller
{
    public function shippingRate()
    {
        $common_data = new Array_();
        $common_data->title = 'Shipping Costs Set';
        $divisionList = Division::get();
        $districtList=District::get();
        $currency = countryList();
        $currencyData=Currency::first();
        $shippingCost=ShippingCost::first();
        return view('adminPanel.setting.shipping_rate')->with(compact('divisionList', 'common_data', 'currency','currencyData','shippingCost','districtList'));
    }

    public function districtList(Request $request)
    {
        $common_data = new Array_();
        $districtList = District::where('division_id', $request->division_id)->get();
        return view('adminPanel.setting._district_list')->with(compact('districtList', 'common_data'))->render();
    }

    public function shippingCostStore(Request $request)
    {
        $ship = ShippingCost::first();
        if ($ship) {
            $shippingCost = $ship;
            $shippingCost->division_id = $request->division_id;
            $shippingCost->district_id = $request->district_id;
            $shippingCost->inside_price = $request->inside_shipping_cost;
            $shippingCost->outside_price = $request->outside_shipping_cost;
            $shippingCost->save();
        } else {
            $shippingCost = new ShippingCost();
            $shippingCost->division_id = $request->division_id;
            $shippingCost->district_id = $request->district_id;
            $shippingCost->inside_price = $request->inside_shipping_cost;
            $shippingCost->outside_price = $request->outside_shipping_cost;
            $shippingCost->save();
        }

        return redirect()->back()->with('success', 'Successfully Update Setting');
    }

    public function currencyCostStore(Request $request)
    {
        $cr = Currency::first();
        if ($cr) {
            $currency = $cr;
            $currency->country_name = $request->currency_country;
            $currency->currency_symbol = $request->currency_symbol;
            $currency->par_dollar_rate = $request->dollar_rate;
            $currency->save();

        } else {
            $currency = new Currency();
            $currency->country_name = $request->currency_country;
            $currency->currency_symbol = $request->currency_symbol;
            $currency->par_dollar_rate = $request->dollar_rate;
            $currency->save();
        }
        return redirect()->back()->with('success', "Successfully Currency Updated");

    }


    public function faqView(){
        $faqList=Faq::get();
        return view('adminPanel.setting.faq')->with(compact('faqList'));
    }
    public function faqStore(Request $request){

        $faqdata=new Faq();
        $faqdata->title=$request->title;
        $faqdata->details=$request->details;
        $faqdata->save();
        return redirect()->back()->with('success', "Successfully created faq");
    }
    public function faqEdit(Request $request){
        $faqdata=Faq::find($request->id);
        $faqdata->title=$request->title;
        $faqdata->details=$request->details;
        $faqdata->save();
        return redirect()->back()->with('success', "Successfully updated faq");
    }

    public function faqDelete(Request $request){
        $faqdata=Faq::where('id',$request->id)->delete();
        return redirect()->back()->with('success', "Successfully deleted faq");
    }

    public function adsView(){
        $adsList= Ads::get();
        return view('adminPanel.ads.ads_list')->with(compact('adsList'));
    }
    public function adsStore(Request $request){
         $adslist=new Ads();
         $adslist->img=$this->adimg($request->banner_img);
         $adslist->position=$request->position;
         $adslist->save();
        return redirect()->back()->with('success', "Successfully Ads  created");
    }
    public function adsEdit(Request $request){
        Ads::where('position',$request->position)->update(['position'=>null]);
        $adslist=Ads::find($request->id);
        if($request->updateImage){
            $adslist->img=$this->adimg($request->updateImage);
        }
        $adslist->position=$request->position;
        $adslist->save();
        return redirect()->back()->with('success','successfully updated Ads');
    }
//    public function adsDelete(){
//        return $request;
//    }


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


    public function adimg($image)
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

            $logo_image = Image::make(file_get_contents($image));
            $logo_image->brightness(8);
            $logo_image->contrast(11);
            $logo_image->sharpen(5);
            $logo_image->encode('webp', 70);
            $logo_image->save($logo_path);

            return $db_media_img_path;

        }

    }

}
