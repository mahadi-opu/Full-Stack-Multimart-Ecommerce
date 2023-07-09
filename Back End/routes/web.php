<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BankAccountController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CompanyInfoController;
use App\Http\Controllers\Admin\FeaturedLinkController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\offerController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PosController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductSubcategoryController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\api\StripePaymentController;
use App\Models\Supplier;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [AdminController::class, 'loginView'])->name('login');

Route::post('admin/login', array(AdminController::class, 'loginAdmin'))->name('admin.login');

Route::group(['middleware' => 'authCheck'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/create/product/view', [ProductController::class, 'createProduct'])->name('admin.create.product');
    Route::post('/product/store', [ProductController::class, 'storeProduct'])->name('admin.store.product');
    Route::get('/product/list', [ProductController::class, 'productList'])->name('admin.product.list');
    Route::get('/product/edit/info', [ProductController::class, 'productEditDetails'])->name('product.edit.info');
    Route::get('/product/image/delete', [ProductController::class, 'imageDelete'])->name('product.image.delete');
    Route::post('/product/update', [ProductController::class, 'productUpdate'])->name('admin.edit.product');
    Route::get('/product/color', [ProductController::class, 'productColor'])->name('admin.product.color.show');
    Route::post('/product/color/store', [ProductController::class, 'productColorStore'])->name('admin.product.color.store');
    Route::post('/product/color/update', [ProductController::class, 'productColorUpdate'])->name('admin.product.color.update');

    Route::get('/product/size', [ProductController::class, 'productSize'])->name('admin.product.size.show');
    Route::post('/product/size/store', [ProductController::class, 'productSizeStore'])->name('admin.product.size.store');
    Route::post('/product/size/update', [ProductController::class, 'productSizeUpdate'])->name('admin.product.size.update');

    Route::get('/product/category', [ProductCategoryController::class, 'productCategory'])->name('admin.product.category');
    Route::post('/product/category/store', [ProductCategoryController::class, 'productCategoryStore'])->name('admin.store.category');
    Route::post('/product/category/update', [ProductCategoryController::class, 'productCategoryUpdate'])->name('admin.update.category');
    Route::get('/product/category/delete', [ProductCategoryController::class, 'productCategoryDelete'])->name('admin.delete.category');

    Route::get('/product/brand', [BrandController::class, 'brandShow'])->name('admin.product.brand');
    Route::post('/product/brand/store', [BrandController::class, 'brandStore'])->name('admin.product.brand.store');

    Route::post('/product/brand/update', [BrandController::class, 'brandUpdate'])->name('admin.product.brand.update');

    Route::get('/product/subcategory', [ProductSubcategoryController::class, 'productSubcategory'])->name('admin.product.subcategory');
    Route::post('/product/subcategory/store', [ProductSubcategoryController::class, 'productSubCategoryStore'])->name('admin.store.subcategory');
    Route::post('/product/subcategory/update', [ProductSubcategoryController::class, 'productSubCategoryUpdate'])->name('admin.update.subcategory');
    Route::get('/product/subcategory/delete', [ProductSubcategoryController::class, 'productSubCategoryDelete'])->name('admin.delete.subcategory');
    Route::get('/product/subcategory/list/get', [ProductSubcategoryController::class, 'subcategoryListGet'])->name('subcategory.list.get');


    Route::get('/supplier/list', [SupplierController::class, 'supplierList'])->name('admin.supplier.list');
    Route::post('/supplier/store', [SupplierController::class, 'supplierStore'])->name('admin.store.supplier');
    Route::get('/supplier/edit/info', [SupplierController::class, 'supplierEditInfo'])->name('supplier.edit.info');
    Route::post('/supplier/update', [SupplierController::class, 'supplierUpdate'])->name('admin.update.supplier');

    Route::get('/bank/list', [BankAccountController::class, 'bankList'])->name('admin.bank.list');
    Route::post('/bank/store', [BankAccountController::class, 'bankStore'])->name('admin.store.bank');
    Route::post('/bank/update', [BankAccountController::class, 'bankUpdate'])->name('admin.update.bank');

    Route::get('/pos/customer', [PosController::class, 'posCustomerList'])->name('admin.pos.customer.list');
    Route::post('/pos/customer/store', [PosController::class, 'posCustomerStore'])->name('admin.store.pos.customer');
    Route::get('/pos/customer/store/in-pos', [PosController::class, 'posCustomerStoreInPos'])->name('admin.pos.customer.add.in-pos');
    Route::post('/pos/customer/update', [PosController::class, 'posCustomerUpdate'])->name('admin.pos.customer.update');
    Route::get('/pos/view', [PosController::class, 'posView'])->name('admin.pos.view');
    Route::get('/pos/product/get', [PosController::class, 'getPostProductList'])->name('admin.pos.product.get');
    Route::get('/pos/product/src/get', [PosController::class, 'postProductSearch'])->name('admin.pos.product.src');
    Route::get('/pos/sell/item/get', [PosController::class, 'sellItemGet'])->name('admin.pos.sell.item.get');
    Route::post('/pos/payment/store', [PosController::class, 'posPaymentStore'])->name('pos.payment.store');

    Route::get('/product/stock/view', [PurchaseController::class, 'purchaseProductView'])->name('admin.product.purchase');
    Route::get('/product/purchase/list', [PurchaseController::class, 'purchaseList'])->name('admin.product.purchase.list');
    Route::get('/purchase/supplier/store', [SupplierController::class, 'purchaseSupplierStore'])->name('admin.supplier.store.form.purchase');
    Route::get('/purchase/item/get', [SupplierController::class, 'purchaseItemGet'])->name('admin.pos.purchase.item.get');
    Route::post('/purchase/payment/store', [PurchaseController::class, 'purchasePaymentStore'])->name('purchase.payment.store');

    Route::get('/purchase/invoice', [PurchaseController::class, 'purchaseInvoice'])->name('purchase.invoice');

    Route::get('/post/sell/list', [PosController::class, 'sellList'])->name('sell.list');

    Route::get('/post/offer/list', [offerController::class, 'offerList'])->name('offer.list');

    Route::post('admin/store/offer', [offerController::class, 'storeOffer'])->name('admin.store.offer');
    Route::get('admin/set/offer/product', [offerController::class, 'setOfferProduct'])->name('admin.set.offer.product');

    Route::get('admin/offer/product/list', [offerController::class, 'offerProductList'])->name('admin.offer.product.list');

    Route::post('admin/offer/product/store', [offerController::class, 'storeOfferProduct'])->name('admin.offer.product.store');

    Route::get('admin/product/offerProduct/delete', [offerController::class, 'offerProductDelete'])->name('admin.product.offerProduct.delete');

    Route::get('admin/delete/offer/banner', [offerController::class, 'offerBannerDelete'])->name('admin.delete.offer.banner');
    Route::post('admin/update/offer', [offerController::class, 'offerBannerUpdate'])->name('admin.update.offer');

    Route::get('sell/invoice', [PosController::class, 'sellInvoice'])->name('sell.invoice');

    Route::get('product/barcode/generate', [ProductController::class, 'productBarcodeGenerate'])->name('product.barcode.generate');

    Route::get('admin/order/all', [OrderController::class, 'orderAll'])->name('admin.order.all');
    Route::get('admin/order/pending', [OrderController::class, 'orderPending'])->name('admin.order.pending');
    Route::get('admin/order/processing', [OrderController::class, 'orderProcessing'])->name('admin.order.processing');
    Route::get('admin/order/on-the-way', [OrderController::class, 'orderOnTheWay'])->name('admin.order.on-the-way');
    Route::get('admin/order/cancel/request', [OrderController::class, 'orderCancelRequest'])->name('admin.order.cancel.request');
    Route::get('admin/order/cancel/accept', [OrderController::class, 'orderCancelAccept'])->name('admin.order.cancel.accept');
    Route::get('admin/order/cancel/completed', [OrderController::class, 'orderCancelCompleted'])->name('admin.order.cancel.completed');
    Route::get('admin/order/complete', [OrderController::class, 'OrderComplete'])->name('admin.order.completed');

    Route::get('admin/order/status/update', [OrderController::class, 'OrderStatusUpdate'])->name('admin.order.status.update');
    Route::get('admin/sell/order/details', [OrderController::class, 'SellOrderDetails']);
    Route::get('admin/setting/shipping/rate', [SettingController::class, 'shippingRate'])->name('setting.shipping.rate');
    Route::get('admin/report/product/sell', [ReportController::class, 'sellReport'])->name('admin.report.sell');
    Route::get('admin/report/product/sell/profit', [ReportController::class, 'sellProfitReport'])->name('admin.report.sell.profit');
    Route::get('admin/district/list/get', [SettingController::class, 'districtList']);
    Route::post('admin/shipping/cost/setting/store', [SettingController::class, 'shippingCostStore'])->name('shipping.cost.setting.store');
    Route::post('admin/currency/setting/store', [SettingController::class, 'currencyCostStore'])->name('currency.setting.store');
    Route::post('admin/company/info', [CompanyInfoController::class, 'CompanyInfo'])->name('company.info.store');

    //Route::get('admin/setting/company/details', [CompanyInfoController::class, 'companyDetails'])->name('setting.company.details');

    Route::get('admin/logout', array(AdminController::class, 'logOutAdmin'))->name('admin.logout');
    Route::get('admin/role', array(AdminController::class, 'adminRole'))->name('admin.role.create');
    Route::post('admin/role/store', array(AdminController::class, 'adminRoleStore'))->name('admin.role.store');
    Route::get('admin/create', array(AdminController::class, 'adminCreate'))->name('admin.admin.create');
    Route::post('admin/store', array(AdminController::class, 'adminStore'))->name('admin.admin.store');
    Route::get('admin/delete', array(AdminController::class, 'adminDelete'))->name('admin.admin.delete');
    Route::get('admin/setting/company/details', [CompanyInfoController::class, 'companyDetails'])->name('setting.company.details');

    Route::get('admin/featured/link/list', [FeaturedLinkController::class, 'featuredLinkList'])->name('admin.featured.link.list');
    Route::post('admin/featured/store', [FeaturedLinkController::class, 'featuredLinkStore'])->name('admin.featured.store');
    Route::post('admin/featured/update', [FeaturedLinkController::class, 'featuredLinkUpdate'])->name('admin.featured.update');

    Route::get('admin/faq', [SettingController::class, 'faqView'])->name('faq.view');
    Route::post('admin/faq/store', [SettingController::class, 'faqStore'])->name('faq.store');
    Route::post('admin/faq/edit', [SettingController::class, 'faqEdit'])->name('faq.edit');
    Route::get('admin/faq/deleted', [SettingController::class, 'faqDelete'])->name('faq.delete');


    Route::get('admin/ads', [SettingController::class, 'adsView'])->name('ads.view');
    Route::post('admin/ads/store', [SettingController::class, 'adsStore'])->name('ads.store');
    Route::post('admin/ads/edit', [SettingController::class, 'adsEdit'])->name('admin.update.ads');
    Route::get('admin/ads/deleted', [SettingController::class, 'adsDelete'])->name('ads.delete');


});


