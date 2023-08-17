<?php

use App\Http\Controllers\AuthController;

use App\Http\Controllers\PageController;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTitleController;
use App\Http\Controllers\ProductColorController;
use App\Http\Controllers\ProductSizeController;
use App\Http\Controllers\ProductStorageController;
use App\Http\Controllers\ProductUsedController;
use App\Http\Controllers\CompanyController;

use App\Http\Controllers\MakerController;

use App\Http\Controllers\BrandController;

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

// Route::resource('/', PageController::class);
Route::get('/', [PageController::class, 'index']);

Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');
  
    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');
  
    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function (){
    Route::get('dashboard', function (){
        return view('dashboard');
    })->name('dashboard');

    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);

    Route::resource('profile', ProfileController::class);

    Route::resource('category', CategoryController::class);
    
    Route::resource('product', ProductController::class);
    Route::resource('productTitle', ProductTitleController::class);
    // Route::resource('productImage', ProductImageController::class);
    Route::resource('productColor', ProductColorController::class);
    Route::resource('productSize', ProductSizeController::class);
    Route::resource('productStorage', ProductStorageController::class);
    Route::resource('productUsed', ProductUsedController::class);



    Route::resource('company', CompanyController::class);
    
    Route::resource('maker', MakerController::class);

    Route::resource('brand', BrandController::class);

});

// Route::group(['middleware' => ['auth']], function() {
//     Route::resource('admin/roles', RoleController::class);
//     Route::resource('admin/users', UserController::class);
//     Route::resource('products', ProductController::class);
// });