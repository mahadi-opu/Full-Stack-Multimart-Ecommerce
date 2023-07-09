<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CashOnDeliveryController;
use App\Http\Controllers\Api\CompanyInfoController;
use App\Http\Controllers\Api\OfferController;
use App\Http\Controllers\Api\PopularProductController;
use App\Http\Controllers\Api\ProductCategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductSubcategoryController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\StorageController;
use App\Http\Controllers\api\StripePaymentController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserOrderController;
use App\Http\Controllers\Api\WishListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post("/logout", [AuthController::class, 'logout']);
    Route::post('user/shipping/billing/address', [UserController::class, 'userAddress']);
    Route::get('user/shipping/billing/address/get', [UserController::class, 'userAddressGet']);

    Route::post('stripe/payment', [StripePaymentController::class, 'stripePayment']);
    Route::post('cashOnDelivery/payment', [CashOnDeliveryController::class, 'cashOnDeliveryOrder']);

    Route::get('user/order/list', [UserOrderController::class, 'orderList']);
    Route::get('user/order/details/by/orderId', [UserOrderController::class, 'orderDetails']);
    Route::post('user/changePassword', [AuthController::class, 'changePassword']);
    Route::post('user/wish/list/add', [WishListController::class, 'addWishList']);
    Route::get('user/wish/get', [WishListController::class, 'getWishList']);
    Route::get('user/wish/count', [WishListController::class, 'count']);
    Route::get('user/order/cancel', [UserOrderController::class, 'cancel']);
});
Route::post("/signup", [AuthController::class, 'signup']);
Route::post("/login", [AuthController::class, 'login']);

Route::get('home/popular/product/get', [ProductController::class, 'homePopularProduct']);
Route::get('home/trending/product/get', [ProductController::class, 'homeTrendingProduct']);
Route::get('home/category/product', [ProductController::class, 'categoryProduct']);

Route::get('home/subcategory/product', [ProductController::class, 'subCategoryProduct']);
Route::get('home/subcategory/product/related', [ProductController::class, 'relatedProductGet']);

Route::get('home/new/arrival/product', [ProductController::class, 'newArrivalProduct']);
Route::get('home/best/sell/product', [ProductController::class, 'bestSellProduct']);
Route::get('product/details', [ProductController::class, 'productDetails']);
Route::get('search/product', [ProductController::class, 'srcProductList']);
Route::get('offer/banner', [OfferController::class, 'offerBanner']);
Route::get('offer/product/list', [OfferController::class, 'offerProduct']);
Route::get('product/category', [ProductCategoryController::class, 'categoryList']);
Route::get('product/popular/category', [ProductCategoryController::class, 'popularCategory']);


Route::get('category/wise/subcategory', [ProductSubcategoryController::class, 'categoryWiseSubcategory']);
Route::get('section/product', [ProductController::class, 'sectionProductList']);
Route::get('all/subcategory', [ProductSubcategoryController::class, 'allSubcategory']);
Route::get('all/category/subcategory', [ProductCategoryController::class, 'allCategorySubcategory']);
Route::post('product/price/range/src', [ProductController::class, 'priceRangeSrc']);

Route::get('country/list', [StorageController::class, 'countryList']);
Route::get('shipping/cost/get', [SettingController::class, 'shippingCost']);
Route::get('currency/get', [SettingController::class, 'currency']);
Route::get('division/list', [StorageController::class, 'divisionList']);
Route::get('district/list', [StorageController::class, 'districtList']);
Route::get('product/size/list', [ProductController::class, 'productSizList']);
Route::get('product/color/list', [ProductController::class, 'productColorList']);
Route::get('product/company/info', [CompanyInfoController::class, 'getCompanyInfo']);
Route::get('product/price/min/max', [ProductController::class, 'minMaxPrice']);

Route::get('product/all/color', [ProductController::class, 'allColor']);
Route::get('product/all/size', [ProductController::class, 'allSize']);
Route::get('product/all/brand', [BrandController::class, 'allBrand']);
Route::get('product/top/brand', [BrandController::class, 'topBrand']);

Route::get('product/all/category', [ProductCategoryController::class, 'allCategory']);
Route::get('featured/link/list', [SettingController::class, 'featuredList']);

Route::get('faq/list', [SettingController::class, 'getFaq']);
Route::get('ads/list', [SettingController::class, 'getAds']);






