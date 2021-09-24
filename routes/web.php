<?php

use App\Http\Controllers\DiscountController;
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

Route::get('/', function () {
    return view('welcome');
})->middleware(['verify.shopify'])->name('home');

Route::group(['prefix' => 'product', 'as'=>'product.', 'middleware' => 'verify.shopify'],function(){
    Route::get('index', [ ProductController::class, 'index' ])->name('index');
    Route::get('create', [ ProductController::class, 'create' ])->name('create');
    Route::post('store', [ ProductController::class, 'store' ])->name('store');
    Route::get('sync', [ ProductController::class, 'productSync' ])->name('sync');
    Route::get('edit', [ ProductController::class, 'edit' ])->name('edit');
    Route::post('update', [ ProductController::class, 'update' ])->name('update');
    Route::delete('delete/{id}', [ ProductController::class, 'delete' ])->name('delete');
});

Route::group(['prefix' => 'user', 'as'=>'user.', 'middleware' => 'verify.shopify'],function(){
    Route::get('index', [UserController::class, 'index'])->name('index');
});

Route::group(['prefix' => 'discount', 'as'=>'discount.', 'middleware' => 'verify.shopify'],function(){
    Route::get('index', [DiscountController::class, 'index'])->name('index');
});
