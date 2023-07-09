<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Offer_product_list;
use App\Models\Offer_types;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Supplier;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Array_;
use Image;

class offerController extends Controller
{
    public function offerList()
    {
        $common_data = new Array_();
        $common_data->title = 'Offer List';
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        $offer = Offer::where('deleted', 0)->get();
        return view('adminPanel.offer.offer_list')->with(compact('category', 'offer', 'common_data'));
    }

    public function offerBannerDelete(Request $request){
       $offerProduct=Offer_product_list::where('offer_id',$request->id)->delete();
       $offer=Offer::where('id',$request->id)->delete();
        return redirect()->back()->with('success', 'Successfully  Offer banner deleted');
    }

    public function storeOffer(Request $request)
    {
        $offer = new Offer();
        $offer->offer_name = $request->offer_name;
        $offer->start_date = $request->start_date;
        $offer->end_date = $request->end_date;
        $offer->banner_image = $this->bannerImageSave($request->banner_img);
        $offer->save();
        return redirect()->back()->with('success', 'Successfully Created Offer');
    }

    public function setOfferProduct()
    {

        return view('adminPanel.offer._offer_product_select');
    }

    public function offerProductList(Request $request)
    {
         $offer=Offer::find($request->id);
        $offerName=$offer->offer_name;
        $common_data = new Array_();
        $common_data->title =$offerName.' Products List';
        $offerList = Offer::where('status', 1)->where('deleted', '0')->where('id',$request->id)->get();
        $offerProductList = Offer_product_list::where('status', 1)->where('deleted', '0')->where('offer_id',$request->id)->get();
        $productList = Product::where('status', 1)->where('deleted', '0')->get();
        return view('adminPanel.offer.offer_product_list')->with(compact('offerList', 'productList', 'offerProductList','offer', 'common_data'));
    }

    public function storeOfferProduct(Request $request)
    {
        foreach ($request->offer_product_list as $key => $product_id) {
            $offerProduct = new Offer_product_list();
            $offerProduct->product_id = $product_id;
            $offerProduct->offer_id = $request->offer_id;
            $offerProduct->offer_type = $request->offer_type;
            $offerProduct->offer_amount = $request->amount;
            $offerProduct->save();
        }
        return redirect()->back()->with('success', 'Successfully offer Product Saved');

    }

    public function offerProductDelete(Request $request)
    {
        Offer_product_list::where('id', $request->id)->delete();
        return redirect()->back()->with('success', 'Successfully Deleted Offer Product');
    }

    public function offerBannerUpdate(Request $request){
        $offer = Offer::find($request->offer_id);
        $offer->offer_name = $request->offer_name;
        $offer->start_date = $request->start_date;
        $offer->end_date = $request->end_date;
        if($request->updateImage){
            $offer->banner_image = $this->bannerImageSave($request->updateImage);
        }
        $offer->save();
        return redirect()->back()->with('success', 'Successfully  Offer Updated');


    }


    public function bannerImageSave($image)
    {
        if (isset($image) && ($image != '') && ($image != null)) {
            $ext = explode('/', mime_content_type($image))[1];

            $logo_url = "banner_images-" . time() . rand(1000, 9999) . '.' . $ext;
            $logo_directory = getUploadPath() . '/banner_images/';
            $filePath = $logo_directory;
            $logo_path = $filePath . $logo_url;
            $db_media_img_path = 'storage/banner_images/' . $logo_url;

            if (!file_exists($filePath)) {
                mkdir($filePath, 666, true);
            }

            $logo_image = Image::make(file_get_contents($image))->resize(700, 400);
            $logo_image->brightness(8);
            $logo_image->contrast(11);
            $logo_image->sharpen(5);
            $logo_image->encode('webp', 70);
            $logo_image->save($logo_path);

            return $db_media_img_path;

        }

    }
}
