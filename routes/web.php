<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\WishlistController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\SizeController;

Auth::routes();
Route::prefix('admin')->middleware('isAdmin', 'auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');


    Route::controller(CategoryController::class)->group(function ()
    {
        Route::get('category', 'index')->name('category.index');
        Route::get('category/create', 'create')->name('category.create');
        Route::post('category', 'store')->name('category.store');
        Route::get('category/edit/{id}/{s_id?}', 'edit')->name('category.edit');
        Route::patch('/category/{id}/{s_id?}', 'update')->name('category.update');
        Route::get('/category/{id}/{s_id?}', 'destroy')->name('category.delete');
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
        Route::post('product-size/{prod_size_id}', 'updateProductSizeQty');
        Route::get('product-size/{prod_size_id}/delete', 'deleteProductSizeQty');

        Route::get('fetch-sub-cate',  'fetchSubCate')->name('getSubCate');
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

    Route::controller(SizeController::class)->group(function ()
    {
        Route::get('size', 'index')->name('size.index');
        Route::get('size/create', 'create')->name('size.create');
        Route::post('size', 'store')->name('size.store');
        Route::get('size/edit/{id}', 'edit')->name('size.edit');
        Route::patch('/size/{id}', 'update')->name('size.update');
        Route::get('/size/{id}', 'destroy')->name('size.delete');
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


    Route::controller(OrderController::class)->group(function ()
    {
        Route::get('order', 'index')->name('order.index');
        Route::get('view-order/{id}', 'show')->name('order.view');
        Route::patch('order/{id}', 'update')->name('order.update');
        Route::get('order-history', 'viewHistory')->name('order.history');
        Route::get('order/{id}', 'destroy')->name('order.delete');
    });

    Route::controller(SaleController::class)->group(function ()
    {
        Route::get('sale', 'index')->name('sale.index');
        Route::get('sale/edit/{id}', 'edit')->name('sale.edit');
        Route::patch('/sale/{id}', 'update')->name('sale.update');
    });

    Route::controller(AdminUserController::class)->group(function ()
    {
        Route::get('user', 'index')->name('user.index');
        Route::get('user/create', 'create')->name('user.create');
        Route::post('user', 'store')->name('user.store');
        Route::get('view-user/{id}', 'show')->name('user.view');
        Route::get('edit-user/{id}', 'edit')->name('user.edit');
        Route::patch('user/{id}', 'update')->name('user.update');
        Route::get('delete-user/{id}', 'destroy')->name('user.delete');
    });

});



Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');
Route::get('/shop/{category_slug?}/{sub_cate_slug?}', [FrontendController::class, 'products'])->name('frontend.products');
Route::get('/shop/{category_slug}/{sub_cate_slug}/{product_slug}', [FrontendController::class, 'productDetails']);
Route::get('/product-list', [FrontendController::class, 'getProductListAjax']);
Route::post('/search-product', [FrontendController::class, 'searchProduct']);

Route::get('/add-to-cart/{id}', [CartController::class, 'addProductInAllProductPage']);
Route::post('/add-to-cart', [CartController::class, 'addProduct']);
Route::post('/delete-cart-item', [CartController::class, 'deleteProduct']);
Route::post('/update-cart-item', [CartController::class, 'updateProduct']);
Route::post('/add-to-wishlist', [WishlistController::class, 'store']);
Route::get('/add-to-wishlist/{id}', [WishlistController::class, 'storeInProductPage']);
Route::get('/delete-from-wishlist/{id}', [WishlistController::class, 'destroy']);


Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'viewCart'])->name('frontend.cart.view');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('frontend.checkout.view');
    Route::post('/place-order', [CheckoutController::class, 'placeOrder'])->name('frontend.checkout.place-order');
    Route::get('/my-orders', [UserController::class, 'listOrders'])->name('frontend.order.view');
    Route::get('/view-orders/{id}', [UserController::class, 'viewOrder'])->name('frontend.order.details');
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('frontend.wishlist.index');
    Route::get('/review-item/{order_item_id}', [ReviewController::class, 'create']);
    Route::post('/add-review', [ReviewController::class, 'store'])->name('frontend.review.store');
    Route::get('/profile', [UserController::class, 'showProfile'])->name('frontend.user.profile');
    Route::get('/profile/edit/{id}', [UserController::class, 'editProfile'])->name('frontend.user.profile-edit');
    Route::patch('/profile/update/{id}', [UserController::class, 'updateProfile'])->name('frontend.user.profile-update');

});










