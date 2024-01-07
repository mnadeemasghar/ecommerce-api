<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
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


Route::get('/login',[AuthController::class,'login'])->name('login');
Route::post('/login_attempt',[AuthController::class,'login_attempt'])->name('login_attempt');

Route::middleware(['auth'])->group(function(){
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');
    
    Route::get('/', function () {
        return view('welcome');
    })->name('home');
    
    Route::get('/categories',[CategoryController::class,'index'])->name('categories');
    Route::get('/categories/create',[CategoryController::class,'create'])->name('categories.create');
    Route::get('/categories/show/{id}',[CategoryController::class,'show'])->name('categories.show');
    Route::get('/categories/edit/{id}',[CategoryController::class,'edit'])->name('categories.edit');
    Route::post('/categories/update/{id}',[CategoryController::class,'update'])->name('categories.update');
    Route::post('/categories/store',[CategoryController::class,'store'])->name('categories.store');
    Route::post('/categories/delete/{id}',[CategoryController::class,'destroy'])->name('categories.destroy');
});
