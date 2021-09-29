<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

// Route::get('/', function () {
//     return view('welcome');
// })->middleware(['verify.shopify', 'billable'])->name('home');

Route::get('/proxy_url', function () {
    return 'Proxy URL';
})->middleware(['auth.proxy']);

Route::get('login', [HomeController::class, 'login'])->name('login.get');

Route::group(['middleware' => ['verify.shopify', 'billable']],function(){
    Route::get('/', [HomeController::class, 'index'])->name('home');
});

Route::group(['prefix' => 'product', 'as'=>'product.', 'middleware' => 'verify.shopify'],function(){
    Route::get('index/{link?}', [ ProductController::class, 'index' ])->name('index');
    Route::get('create', [ ProductController::class, 'create' ])->name('create');
    Route::post('store', [ ProductController::class, 'store' ])->name('store');
    Route::get('sync', [ ProductController::class, 'productSync' ])->name('sync');
    Route::get('edit', [ ProductController::class, 'edit' ])->name('edit');
    Route::post('update', [ ProductController::class, 'update' ])->name('update');
    Route::delete('delete/{id}', [ ProductController::class, 'delete' ])->name('delete');
});

Route::group(['prefix' => 'plan', 'as'=>'plan.', 'middleware' => 'verify.shopify'],function(){
    Route::get('index', [PlanController::class, 'index'])->name('index');
});

Route::group(['prefix' => 'customer', 'as'=>'customer.', 'middleware' => 'verify.shopify'],function(){
    Route::get('index/{link?}', [CustomerController::class, 'index'])->name('index');
    Route::get('sync', [ CustomerController::class, 'customerSync' ])->name('sync');
});

Route::group(['prefix' => 'discount', 'as'=>'discount.', 'middleware' => 'verify.shopify'],function(){
    Route::get('index', [DiscountController::class, 'index'])->name('index');
});
