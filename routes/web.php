<?php

use App\Http\Controllers\Backend\CampaignController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\FeedbackController;
use App\Http\Controllers\Backend\LoginController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Backend\ConfigController;
use App\Http\Controllers\Backend\ProductPromotionController;
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

Route::get('generate', function (){
    \Illuminate\Support\Facades\Artisan::call('storage:link');
    $exitCode = Artisan::call('optimize:clear');
    echo 'ok';
});

Route::group(['namespace' => 'Backend','prefix' => 'backend'], function() {
    Route::get('/login', [LoginController::class, 'getLogin'])
        ->name('backend.getLogin');
    Route::post('/login', [LoginController::class, 'login'])
        ->name('backend.login');
});

Route::group(['namespace' => 'Backend','prefix' => 'backend','middleware' => ['web', 'check.login.admin']], function() {
    Route::get('/logout', [LoginController::class, 'logout'])
        ->name('backend.logout');
    Route::group(['prefix' => 'category'], function() {

        Route::get('/', [CategoryController::class, 'index'])
            ->name('backend.category.index');

        Route::get('/create', [CategoryController::class, 'create'])
            ->name('backend.category.create');
        Route::post('/store', [CategoryController::class, 'store'])
            ->name('backend.category.store');

        Route::get('/edit/{id}', [CategoryController::class, 'edit'])
            ->name('backend.category.edit');
        Route::post('/update/{id}', [CategoryController::class, 'update'])
            ->name('backend.category.update');

        Route::get('/destroy/{id}', [CategoryController::class, 'destroy'])
            ->name('backend.category.destroy');

    });

    Route::group(['prefix' => 'campaign'], function() {

        Route::get('/', [CampaignController::class, 'index'])
            ->name('backend.campaign.index');

        Route::get('/create', [CampaignController::class, 'create'])
            ->name('backend.campaign.create');
        Route::post('/store', [CampaignController::class, 'store'])
            ->name('backend.campaign.store');

        Route::get('/edit/{id}', [CampaignController::class, 'edit'])
            ->name('backend.campaign.edit');
        Route::post('/update/{id}', [CampaignController::class, 'update'])
            ->name('backend.campaign.update');

        Route::get('/destroy/{id}', [CampaignController::class, 'destroy'])
            ->name('backend.campaign.destroy');

    });

    Route::group(['prefix' => 'feedback'], function() {

        Route::get('/', [FeedbackController::class, 'index'])
            ->name('backend.feedback.index');

        Route::get('/create', [FeedbackController::class, 'create'])
            ->name('backend.feedback.create');
        Route::post('/store', [FeedbackController::class, 'store'])
            ->name('backend.feedback.store');

        Route::get('/edit/{id}', [FeedbackController::class, 'edit'])
            ->name('backend.feedback.edit');
        Route::post('/update/{id}', [FeedbackController::class, 'update'])
            ->name('backend.feedback.update');

        Route::get('/destroy/{id}', [FeedbackController::class, 'destroy'])
            ->name('backend.feedback.destroy');

    });
    
    Route::group(['prefix' => 'promotion'], function() {

        Route::get('/', [ProductPromotionController::class, 'index'])
            ->name('backend.promotion.index');

        Route::get('/create', [ProductPromotionController::class, 'create'])
            ->name('backend.promotion.create');
        Route::post('/store', [ProductPromotionController::class, 'store'])
            ->name('backend.promotion.store');

        Route::get('/edit/{id}', [ProductPromotionController::class, 'edit'])
            ->name('backend.promotion.edit');
        Route::post('/update/{id}', [ProductPromotionController::class, 'update'])
            ->name('backend.promotion.update');

        Route::get('/destroy/{id}', [ProductPromotionController::class, 'destroy'])
            ->name('backend.promotion.destroy');

    });

    Route::group(['prefix' => 'post'], function() {

        Route::get('/', [PostController::class, 'index'])
            ->name('backend.post.index');

        Route::get('/create', [PostController::class, 'create'])
            ->name('backend.post.create');
        Route::post('/store', [PostController::class, 'store'])
            ->name('backend.post.store');

        Route::get('/edit/{id}', [PostController::class, 'edit'])
            ->name('backend.post.edit');
        Route::post('/update/{id}', [PostController::class, 'update'])
            ->name('backend.post.update');

        Route::get('/destroy/{id}', [PostController::class, 'destroy'])
            ->name('backend.post.destroy');

    });

    Route::group(['prefix' => 'order'], function() {

        Route::get('/', [OrderController::class, 'index'])
            ->name('backend.order.index');

        Route::get('/create', [OrderController::class, 'create'])
            ->name('backend.order.create');
        Route::post('/store', [OrderController::class, 'store'])
            ->name('backend.order.store');

        Route::get('/edit/{id}', [OrderController::class, 'edit'])
            ->name('backend.order.edit');
        Route::get('/update/{id}', [OrderController::class, 'update'])
            ->name('backend.order.update');

        Route::get('/destroy/{id}', [OrderController::class, 'destroy'])
            ->name('backend.order.destroy');

    });

    Route::group(['prefix' => 'customer'], function() {

        Route::get('/', [CustomerController::class, 'index'])
            ->name('backend.customer.index');

        Route::get('/create', [CustomerController::class, 'create'])
            ->name('backend.customer.create');
        Route::post('/store', [CustomerController::class, 'store'])
            ->name('backend.customer.store');

        Route::get('/edit/{id}', [CustomerController::class, 'edit'])
            ->name('backend.customer.edit');
        Route::post('/update/{id}', [CustomerController::class, 'update'])
            ->name('backend.customer.update');

        Route::get('/destroy/{id}', [CustomerController::class, 'destroy'])
            ->name('backend.customer.destroy');

    });

    Route::group(['prefix' => 'product'], function() {

        Route::get('/', [ProductController::class, 'index'])
            ->name('backend.product.index');

        Route::get('/create', [ProductController::class, 'create'])
            ->name('backend.product.create');
        Route::post('/store', [ProductController::class, 'store'])
            ->name('backend.product.store');

        Route::get('/edit/{id}', [ProductController::class, 'edit'])
            ->name('backend.product.edit');
        Route::post('/update/{id}', [ProductController::class, 'update'])
            ->name('backend.product.update');

        Route::get('/destroy/{id}', [ProductController::class, 'destroy'])
            ->name('backend.product.destroy');
        Route::post('/destroy-product-detail-image', [ProductController::class, 'destroyProductDetailImage'])
            ->name('backend.product.destroy_product_detail_image');


    });
    
    Route::group(['prefix' => 'config'], function() {

        Route::get('/', [ConfigController::class, 'index'])
            ->name('backend.config.index');

        Route::get('/create', [ConfigController::class, 'create'])
            ->name('backend.config.create');
        Route::post('/store', [ConfigController::class, 'store'])
            ->name('backend.config.store');

        Route::get('/edit/{id}', [ConfigController::class, 'edit'])
            ->name('backend.config.edit');
        Route::post('/update/{id}', [ConfigController::class, 'update'])
            ->name('backend.config.update');

        Route::get('/destroy/{id}', [ConfigController::class, 'destroy'])
            ->name('backend.config.destroy');

    });
});

Route::group(['namespace' => 'Frontend'], function() {
    Route::get('/', [HomeController::class, 'index'])
        ->name('frontend.home');

    Route::get('/page-search', [HomeController::class, 'pageSearch'])
        ->name('frontend.pageSearch');

    Route::get('/search', [HomeController::class, 'getSearch'])
        ->name('frontend.getSearch');

    Route::get('/page-about-us', [HomeController::class, 'pageAboutUs'])
        ->name('frontend.pageAboutUs');

    Route::get('/page-shipping', [HomeController::class, 'pageShipping'])
        ->name('frontend.pageShipping');

    Route::get('/page-contact', [HomeController::class, 'pageContact'])
        ->name('frontend.pageContact');

    Route::post('/page-contact', [HomeController::class, 'createContact'])
        ->name('frontend.createContact');

    Route::get('/refund-policy', [HomeController::class, 'pageRefundPolicy'])
        ->name('frontend.pageRefundPolicy');

    Route::get('/privacy', [HomeController::class, 'pagePrivacy'])
        ->name('frontend.pagePrivacy');

    Route::get('/campaign/{slug}', [HomeController::class, 'campaign'])
        ->name('frontend.campaign');

    Route::get('/category/{slug}', [HomeController::class, 'category'])
        ->name('frontend.category');

    Route::get('/detail-product/{slug}', [HomeController::class, 'detailProduct'])
        ->name('frontend.detailProduct');

    Route::get('/list-cart', [HomeController::class, 'listCart'])
        ->name('frontend.listCart');

    Route::get('/add-to-cart/{id}', [HomeController::class, 'addToCart'])
        ->name('frontend.addToCart');

    Route::get('/update-cart/{id}', [HomeController::class, 'updateCart'])
        ->name('frontend.updateCart');

    Route::post('/create-order', [HomeController::class, 'createOrder'])
        ->name('frontend.createOrder');

    Route::get('/product-all', [HomeController::class, 'productAll'])
        ->name('frontend.productAll');

});
