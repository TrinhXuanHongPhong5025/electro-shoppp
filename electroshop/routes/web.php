<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/',[App\Http\Controllers\HomeController::class, 'index'])->name('homepage');
Route::get('/store',[App\Http\Controllers\HomeController::class, 'store']);
Route::post('/tim-kiem',[App\Http\Controllers\HomeController::class, 'search']);
Route::get('/status-order/{customer_id}',[App\Http\Controllers\HomeController::class,'status_order']);

//Danh mục sản phẩm trang chủ
Route::get('/danh-muc-san-pham/{category_id}',[App\Http\Controllers\CategoryProduct::class,'show_category_home']);
Route::get('/thuong-hieu-san-pham/{brand_id}',[App\Http\Controllers\BrandProduct::class,'show_brand_home']);
Route::get('/chi-tiet-san-pham/{product_id}',[App\Http\Controllers\ProductController::class,'details_product']);

//backend
Route::get('/admin',[App\Http\Controllers\AdminController::class,'index']);
Route::post('/admin-dashboard',[App\Http\Controllers\AdminController::class,'dashboard']);
Route::get('/dashboard',[App\Http\Controllers\AdminController::class,'show_dashboard']);
Route::get('/logout',[App\Http\Controllers\AdminController::class,'logout']);
Route::get('/sign', [App\Http\Controllers\AdminController::class, 'signup']);
Route::post('/add-account', [App\Http\Controllers\AdminController::class, 'createAccount']);

//Category
Route::get('/add-category-product',[App\Http\Controllers\CategoryProduct::class,'add_category_product']);
Route::get('/all-category-product',[App\Http\Controllers\CategoryProduct::class,'all_category_product']);
Route::post('/save-category-product',[App\Http\Controllers\CategoryProduct::class,'save_category_product']);
Route::get('/edit-category-product{category_product_id}',[App\Http\Controllers\CategoryProduct::class,'edit_category_product']);
Route::post('/update-category-product{category_product_id}',[App\Http\Controllers\CategoryProduct::class,'update_category_product'])->name('update-category-product');
Route::get('/delete-category-product{category_product_id}',[App\Http\Controllers\CategoryProduct::class,'delete_category_product']);
Route::get('/unactive-category-product{category_product_id}',[App\Http\Controllers\CategoryProduct::class,'unactive_category_product'])->name('unactive-category-product');
Route::get('/active-category-product{category_product_id}',[App\Http\Controllers\CategoryProduct::class,'active_category_product'])->name('active-category-product');
//Brand
Route::get('/add-brand-product',[App\Http\Controllers\BrandProduct::class,'add_brand_product']);
Route::get('/all-brand-product',[App\Http\Controllers\BrandProduct::class,'all_brand_product']);
Route::post('/save-brand-product',[App\Http\Controllers\BrandProduct::class,'save_brand_product']);
Route::get('/edit-brand-product{brand_product_id}',[App\Http\Controllers\BrandProduct::class,'edit_brand_product']);
Route::get('/delete-brand-product{brand_product_id}',[App\Http\Controllers\BrandProduct::class,'delete_brand_product']);
Route::post('/update-brand-product{brand_product_id}',[App\Http\Controllers\BrandProduct::class,'update_brand_product'])->name('update-brand-product');
Route::get('/unactive-brand-product{brand_product_id}',[App\Http\Controllers\BrandProduct::class,'unactive_brand_product'])->name('unactive-brand-product');
Route::get('/active-brand-product{brand_product_id}',[App\Http\Controllers\BrandProduct::class,'active_brand_product'])->name('active-brand-product');
//Product
Route::get('/add-product',[App\Http\Controllers\ProductController::class,'add_product']);
Route::get('/all-product',[App\Http\Controllers\ProductController::class,'all_product']);
Route::get('/edit-product{product_id}',[App\Http\Controllers\ProductController::class,'edit_product']);
Route::get('/delete-product{product_id}',[App\Http\Controllers\ProductController::class,'delete_product']);
Route::post('/save-product',[App\Http\Controllers\ProductController::class,'save_product']);
Route::post('/update-product{product_id}',[App\Http\Controllers\ProductController::class,'update_product'])->name('update-product');
//Cart
Route::get('/show-cart',[App\Http\Controllers\CartContrller::class,'show_cart']);
Route::get('/delete-to-cart/{rowId}',[App\Http\Controllers\CartContrller::class,'delete_to_cart']);
Route::post('/save-cart',[App\Http\Controllers\CartContrller::class,'save_cart']);
Route::post('/update-cart-quantity',[App\Http\Controllers\CartContrller::class,'update_cart_quantity']);

//Checkout
Route::get('/login-checkout',[App\Http\Controllers\CheckoutController::class,'login_checkout']);
Route::get('/logout-checkout',[App\Http\Controllers\CheckoutController::class,'logout_checkout']);
Route::get('/checkout',[App\Http\Controllers\CheckoutController::class,'checkout']);
Route::get('/payment',[App\Http\Controllers\CheckoutController::class,'payment']);
Route::post('/add-customer',[App\Http\Controllers\CheckoutController::class,'add_customer']);
Route::post('/login-customer',[App\Http\Controllers\CheckoutController::class,'login_customer']);
Route::post('/order-place',[App\Http\Controllers\CheckoutController::class,'order_place']);
Route::post('/save-checkout-customer',[App\Http\Controllers\CheckoutController::class,'save_checkout_customer']);

//Đơn hàng
Route::get('/manager-order',[App\Http\Controllers\CheckoutController::class,'manager_order']);
Route::get('/view-order{orderId}',[App\Http\Controllers\CheckoutController::class,'view_order']);
Route::get('/delete-order{order_id}',[App\Http\Controllers\CheckoutController::class,'delete_order']);
Route::get('/edit-order{order_id}',[App\Http\Controllers\CheckoutController::class,'edit_order']);
Route::post('/update-order{order_id}',[App\Http\Controllers\CheckoutController::class,'update_order']);
