<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontendController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\Admin\ProductController as AdminProductController;

Route::prefix('admin')->middleware('isAdmin', 'auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');


    Route::controller(CategoryController::class)->group(function ()
    {
        Route::get('category', 'index')->name('category.index');
        Route::get('category/create', 'create')->name('category.create');
        Route::post('category', 'store')->name('category.store');
        Route::get('category/edit/{id}', 'edit')->name('category.edit');
        Route::patch('/category/{id}', 'update')->name('category.update');
        Route::get('/category/{id}', 'destroy')->name('category.delete');
    });


    Route::controller(BrandController::class)->group(function ()
    {
        Route::get('brand', 'index')->name('brand.index');
        Route::get('brand/create', 'create')->name('brand.create');
        Route::post('brand', 'store')->name('brand.store');
        Route::get('brand/edit/{id}', 'edit')->name('brand.edit');
        Route::patch('/brand/{id}', 'update')->name('brand.update');
        Route::get('/brand/{id}', 'destroy')->name('brand.delete');
    });


    Route::controller(AdminProductController::class)->group(function ()
    {
        Route::get('product', 'index')->name('product.index');
        Route::get('product/create', 'create')->name('product.create');
        Route::post('product', 'store')->name('product.store');
        Route::get('product/edit/{id}', 'edit')->name('product.edit');
        Route::patch('/product/{id}', 'update')->name('product.update');
        Route::get('/product/{id}', 'destroy')->name('product.delete');

        Route::get('/product-image/{id_img}', 'destroyProductImages')->name('product-img.delete');

        Route::post('product-color/{prod_color_id}', 'updateProductColorQty');
        Route::get('product-color/{prod_color_id}/delete', 'deleteProductColorQty');

    });


    Route::controller(ColorController::class)->group(function ()
    {
        Route::get('color', 'index')->name('color.index');
        Route::get('color/create', 'create')->name('color.create');
        Route::post('color', 'store')->name('color.store');
        Route::get('color/edit/{id}', 'edit')->name('color.edit');
        Route::patch('/color/{id}', 'update')->name('color.update');
        Route::get('/color/{id}', 'destroy')->name('color.delete');
    });


    Route::controller(SliderController::class)->group(function ()
    {
        Route::get('slider', 'index')->name('slider.index');
        Route::get('slider/create', 'create')->name('slider.create');
        Route::post('slider', 'store')->name('slider.store');
        Route::get('slider/edit/{id}', 'edit')->name('slider.edit');
        Route::patch('slider/{id}', 'update')->name('slider.update');
        Route::get('slider/{id}', 'destroy')->name('slider.delete');
    });
});

Auth::routes();


Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');
Route::get('/all-products', [FrontendController::class, 'getAllProducts'])->name('frontend.all_products');
Route::get('/collections', [FrontendController::class, 'categories'])->name('frontend.categories');
Route::get('/collections/{category_slug}', [FrontendController::class, 'products'])->name('frontend.products');
Route::get('/collections/{category_slug}/{product_slug}', [FrontendController::class, 'productDetails']);


Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'viewCart'])->name('frontend.cart.view');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('frontend.checkout.view');
    Route::post('/place-order', [CheckoutController::class, 'placeOrder'])->name('frontend.checkout.place-order');
    Route::get('/my-orders', [UserController::class, 'index'])->name('frontend.order.view');
    Route::get('/view-orders/{id}', [UserController::class, 'view'])->name('frontend.order.details');

});
Route::get('/add-to-cart/{id}', [CartController::class, 'addProductInAllProductPage']);
Route::post('/add-to-cart', [CartController::class, 'addProduct']);
Route::post('/delete-cart-item', [CartController::class, 'deleteProduct']);
Route::post('/update-cart-item', [CartController::class, 'updateProduct']);








