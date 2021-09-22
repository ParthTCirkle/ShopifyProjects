<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OAuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ScriptController;
use App\Http\Controllers\ShopifyWebhookController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|   shopify-proxy-authentication
*/

// Route::get('/shopify-test-app-5', function () {

//     return 'hello';
// });


Route::middleware(['shopify-proxy-authentication'])->group(function () {
    Route::get('/proxy_url', [HomeController::class, 'proxy'])->name('proxy_url');
});

Route::get('authentication', [OAuthController::class, 'index']);
Route::post('authentication', [OAuthController::class, 'create'])->name('createAuthentication');

Route::get('app_authenticate', [OAuthController::class, 'redirectUri'])->name('shopifyCallBack');

Route::middleware(['shopify-webhook'])->group(function () {
    Route::any('webhook/callback', [ShopifyWebhookController::class, 'webhookCallback'])->name('webhookCallback');  // get method return 405 error.
});

Route::middleware(['shopify-authentication'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('install', [HomeController::class, 'redirectToInstallPage'])->name('installPage');
});

Route::get('test', [HomeController::class, 'test'])->name('test');

Route::group(['prefix'=>'product','as'=>'product.','middleware'=> ['shopify-authentication']], function(){
    Route::get('list', [ProductController::class, 'index'])->name('list');
    Route::get('create', [ProductController::class, 'create'])->name('create');
});

Route::group(['prefix'=>'script','as'=>'script.','middleware'=> ['shopify-authentication']], function(){
    Route::get('list', [ScriptController::class, 'list'])->name('list');
});

Route::group(['prefix'=>'asset','as'=>'asset.','middleware'=> ['shopify-authentication']], function(){
    Route::get('index', [AssetController::class, 'index'])->name('index');
});

Route::group(['prefix'=>'customer','as'=>'customer.','middleware'=> ['shopify-authentication']], function(){
    Route::get('view',  [CustomerController::class, 'view'])->name('view');
    Route::get('model', [CustomerController::class, 'model'])->name('model');
    Route::get('list',  [CustomerController::class, 'index'])->name('list');
    Route::get('create', [CustomerController::class, 'create'])->name('create');
    Route::get('update', [CustomerController::class, 'update'])->name('update');
    Route::get('delete', [CustomerController::class, 'delete'])->name('delete');
});

Route::group(['prefix'=>'discount','as'=>'discount.','middleware'=> ['shopify-authentication']], function(){
    Route::get('view', [DiscountController::class, 'view'])->name('view');
});

Route::group(['prefix'=>'user','as'=>'user.','middleware'=> ['shopify-authentication']], function(){
    Route::get('list', [UserController::class, 'index'])->name('list');
});

Route::group(['prefix'=>'plan','as'=>'plan.','middleware'=> ['shopify-authentication']], function(){
    Route::get('list', [PlanController::class, 'list'])->name('list');
    Route::get('view', [PlanController::class, 'viewPlans'])->name('view');
});

Route::group(['prefix'=>'plan','as'=>'plan.','middleware'=> ['plan-create-authentication']], function(){
    Route::get('create', [PlanController::class, 'create'])->name('create');
});

