<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\ChargeController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ScriptController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'product', 'as'=>'product.', 'middleware'=> ['shopify-ajax-authentication']], function(){
    Route::post('create', [ProductController::class, 'store'])->name('store');
    Route::get('edit', [ProductController::class, 'edit'])->name('edit');
    Route::post('update', [ProductController::class, 'update'])->name('update');
    Route::delete('delete', [ProductController::class, 'delete'])->name('delete');
    Route::get('import', [ProductController::class, 'importProducts'])->name('importProducts');
});

Route::group(['prefix'=>'script', 'as'=>'script.', 'middleware'=> ['shopify-ajax-authentication']], function(){
    Route::post('create', [ScriptController::class, 'create'])->name('create');
});

Route::group(['prefix'=>'asset', 'as'=>'asset.', 'middleware'=> ['shopify-ajax-authentication']], function(){
    Route::post('create', [AssetController::class, 'create'])->name('create');
});

Route::group(['prefix'=>'plan', 'as'=>'plan.', 'middleware'=> ['shopify-ajax-authentication']], function(){
    Route::post('store', [PlanController::class, 'store'])->name('store');
    Route::get('edit', [PlanController::class, 'edit'])->name('edit');
    Route::post('update', [PlanController::class, 'update'])->name('update');
    Route::delete('delete', [PlanController::class, 'delete'])->name('delete');
});

Route::group(['prefix'=>'charge', 'as'=>'charge.', 'middleware'=> ['shopify-ajax-authentication']], function(){
    Route::post('create', [ChargeController::class, 'create'])->name('create');
});
