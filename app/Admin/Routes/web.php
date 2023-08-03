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
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/home', [HomeController::class, 'home'])->name('home');
    Route::post('/home', [HomeController::class, 'homeStore'])->name('home.store');
});

