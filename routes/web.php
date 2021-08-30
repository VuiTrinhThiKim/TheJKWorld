<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;


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
//Web page
Route::get('/', [HomeController::class, 'index']);
Route::get('/trang-chu', [HomeController::class, 'index']);

Route::get('/danh-muc/{category_id}', [CategoryController::class, 'show_category']);
Route::get('/thuong-hieu/{brand_id}', [BrandController::class, 'show_brand']);
Route::get('/chi-tiet-san-pham/{product_id}', [ProductController::class, 'show_product_detail']);
//Cart
Route::post('/gio-hang', [CartController::class, 'index']);
Route::get('/xem-gio-hang', [CartController::class, 'show_cart']);
Route::get('/xoa-san-pham-khoi-gio-hang/{cardId}', [CartController::class, 'delete_to_cart']);
Route::post('/cap-nhat-so-luong/{cardId}', [CartController::class, 'update_quantity']);
//Route::get('/gio-hang', [CartController::class, 'cart_ajax']);
//Route::post('/add-to-cart-ajax',[CartController::class, 'add_to_cart_ajax']);

Route::get('/tim-kiem', [HomeController::class, 'search']);
Route::get('/lien-he', [ContactUsController::class, 'index']);

Route::get('/login-to-checkout', [CheckoutController::class, 'checkout_login']);
Route::get('/thong-tin-giao-hang', [CheckoutController::class, 'checkout']);
Route::post('/luu-thong-tin-giao-hang', [CheckoutController::class, 'save_shipping']);

Route::post('/tao-tai-khoan', [CustomerController::class, 'create_customer']);
Route::post('/dang-nhap', [CustomerController::class, 'login']);
Route::get('/dang-xuat', [CustomerController::class, 'logout']);


//Admin page
Route::prefix('admin')->group(function(){

	//Show Login Admin Panel
	Route::get('/', [AdminController::class, 'index']);
	//Show Admin Panel
	Route::get('/dashboard', [AdminController::class, 'showDashboard']);
	//Login to dashboard
	Route::post('/admin-dashboard', [AdminController::class, 'dashboard']);
	//Admin Logout
	Route::get('/logout', [AdminController::class, 'logout']);

	Route::group(['prefix'=>'category'], function(){
		//All Categories
		Route::get('/view-all', [CategoryController::class, 'view_all']);
		//Create Category
		Route::get('/add', [CategoryController::class, 'create']);
		//Add to db
		Route::post('/add', [CategoryController::class, 'store']);
		//Category Status
		Route::get('/public-category/{category_id}', [CategoryController::class, 'update_category_status']);
		Route::get('/unpublic-category/{category_id}', [CategoryController::class, 'update_category_status']);
		//Edit Category
		Route::get('/edit/{category_id}', [CategoryController::class, 'edit']);
		//Update Category
		Route::post('/update/{category_id}', [CategoryController::class, 'update']);
		//Delete Category
		Route::get('/delete/{category_id}', [CategoryController::class, 'destroy']);
		//Save Category

	});

	Route::group(['prefix'=>'brand'], function(){
		//All Brands
		Route::get('/view-all', [BrandController::class, 'view_all']);
		//Create Brand
		Route::get('/add', [BrandController::class, 'create']);
		//Add to db
		Route::post('/add', [BrandController::class, 'store']);
		//Brand Status
		Route::get('/public-brand/{brand_id}', [BrandController::class, 'update_brand_status']);
		Route::get('/unpublic-brand/{brand_id}', [BrandController::class, 'update_brand_status']);
		//Edit Brand
		Route::get('/edit/{brand_id}', [BrandController::class, 'edit']);
		//Update Brand
		Route::post('/update/{brand_id}', [BrandController::class, 'update']);
		//Delete Brand
		Route::get('/delete/{brand_id}', [BrandController::class, 'destroy']);

	});

	Route::group(['prefix'=>'product'], function(){
		//All Product
		Route::get('/view-all', [ProductController::class, 'view_all']);
		//Add Product
		Route::get('/add', [ProductController::class, 'create']);
		//Add to db
		Route::post('/add', [ProductController::class, 'store']);
		//Product Status
		Route::get('/public-product/{product_id}', [ProductController::class, 'update_product_status']);
		Route::get('/unpublic-product/{product_id}', [ProductController::class, 'update_product_status']);
		//Edit Product
		Route::get('/edit/{product_id}', [ProductController::class, 'edit']);
		//Update Product
		Route::post('/update/{product_id}', [ProductController::class, 'update']);
		//Delete Product
		Route::get('/delete/{product_id}', [ProductController::class, 'destroy']);

	});

	Route::group(['prefix'=>'user'], function(){
		//All Product
		Route::get('/view-all', [UserController::class, 'view_all']);
		//Add Product
		Route::get('/add', [UserController::class, 'create']);
		//Add to db
		Route::post('/add', [UserController::class, 'store']);
		//Product Status
		Route::get('/public-user/{user_id}', [UserController::class, 'update_product_status']);
		Route::get('/unpublic-user/{user_id}', [UserController::class, 'update_product_status']);
		//Edit Product
		Route::get('/edit/{user_id}', [UserController::class, 'edit']);
		//Update Product
		Route::post('/update/{user_id}', [UserController::class, 'update']);
		//Delete Product
		Route::get('/delete/{user_id}', [UserController::class, 'destroy']);

	});
});

