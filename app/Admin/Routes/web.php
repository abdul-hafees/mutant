<?php

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

use App\Admin\Http\Controllers\AdminController;
use App\Admin\Http\Controllers\AttributeController;
use App\Admin\Http\Controllers\AttributeValueController;
use App\Admin\Http\Controllers\BannerController;
use App\Admin\Http\Controllers\CategoryController;
use App\Admin\Http\Controllers\CouponsController;
use App\Admin\Http\Controllers\HomeController;
use App\Admin\Http\Controllers\HubsController;
use App\Admin\Http\Controllers\OrderController;
use App\Admin\Http\Controllers\ProductsController;
use App\Admin\Http\Controllers\ProfileController;
use App\Admin\Http\Controllers\ProductsStockController;
use App\Admin\Http\Controllers\RoleController;
use App\Admin\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('admin.login');
})->name('root');

Route::namespace('App\Admin\Http\Controllers')->group(function () {
    Auth::routes();
});

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('edit-profile', [ProfileController::class, 'editProfile'])->name('profile.edit-profile');
    Route::post('edit-profile', [ProfileController::class, 'updateProfile'])->name('profile.update-profile');
    Route::get('change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');
    Route::post('change-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
//    Route::resource('admins', AdminController::class);
    Route::resource('banners', BannerController::class);
//    Route::resource('roles', RoleController::class);
    Route::resource('categories', CategoryController::class);
    Route::get('/categories/{categoryId}/sub-categories',
        [CategoryController::class, 'getSubCategoriesByParent']);
    Route::get('/categories/{categoryId}/get-attributes',
        [CategoryController::class, 'getAttributeByCategory']);
    Route::resource('sub-categories', SubCategoryController::class);
    Route::resource('categories.subcategories', SubCategoryController::class);
    Route::resource('attributes', AttributeController::class);
    Route::get('/get-all-attribute-values',
        [AttributeController::class, 'getAllAttributeValues']);
    Route::resource('products', ProductsController::class);
    Route::post('product-stock-details/update', [ProductsStockController::class, 'updateStockdetails']);
    Route::get('products/delete-image/{imageId}', [ProductsController::class, 'deleteProductImage']);
    Route::resource('attribute-values', AttributeValueController::class);
    Route::resource('hubs', HubsController::class);
    Route::resource('coupons', CouponsController::class);
    Route::resource('orders', OrderController::class);

});

