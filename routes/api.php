<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\HomeController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/home',[HomeController::class,'home']);

Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('{category}', [CategoryController::class, 'show']);
    Route::post('/', [CategoryController::class, 'store']);
    Route::post('{category}', [CategoryController::class, 'update']);
    Route::delete('{category}', [CategoryController::class, 'destroy']);
});

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/search', [ProductController::class, 'search']);
    Route::get('{product}', [ProductController::class, 'show']);
    Route::post('/', [ProductController::class, 'store']);
    Route::post('/addImage', [ProductController::class, 'addImage']);
    Route::post('/removeImage/{product_image}', [ProductController::class, 'removeImage']);
    Route::post('/remove3dImage/{product_image}', [ProductController::class, 'remove3dImage']);
    Route::post('{product}', [ProductController::class, 'update']);
    Route::delete('{product}', [ProductController::class, 'destroy']);
});

Route::post('/register',[AuthController::class,'register']);
Route::post('/verify_email',[AuthController::class,'verify_email']);
Route::post('/verifyPasswordCode',[AuthController::class,'verifyPasswordCode']);
Route::post('/forgotPassword',[AuthController::class,'forgotPassword']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class,'logout'])->middleware('auth:api');
Route::get('/getProfile',[AuthController::class,'getProfile'])->middleware('auth:api');
Route::post('/updateProfile',[AuthController::class,'updateProfile'])->middleware('auth:api');
Route::post('/changePassword',[AuthController::class,'changePassword'])->middleware('auth:api');

Route::post('/addToCart',[OrderController::class,'addToCart'])->middleware('auth:api');
Route::post('/removeFromCart',[OrderController::class,'removeFromCart'])->middleware('auth:api');
Route::post('/placeOrder',[OrderController::class,'placeOrder'])->middleware('auth:api');
Route::get('/getOrders',[OrderController::class,'getOrders'])->middleware('auth:api');