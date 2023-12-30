<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\Admin_controller;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\categoryController;

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

Route::get('/', function () {
    return view('admin.login');
});

Route::group(['prefix' => 'admin'],function(){
    Route::group(['middleware' => 'admin.guest'],function(){
        Route::get('/login',[Admin_controller::class,'index'])->name('admin.login');
        Route::post('/authenticate',[Admin_controller::class,'authenticate'])->name('admin.authenticate');
    });
    Route::group(['middleware' => 'admin.auth'],function(){
        Route::get('/dashboard',[HomeController::class,'index'])->name('admin.dashboard');
        Route::get('/logout',[HomeController::class,'logout'])->name('admin.logout');

        //category routes
        Route::get('/categories',[categoryController::class,'index'])->name('categories');
        Route::get('/categories/create',[categoryController::class,'create'])->name('categories.create');
        Route::post('/categories/store',[categoryController::class,'store'])->name('categories.store');
        Route::get('/categories/edit',[categoryController::class,'edit'])->name('categories.edit');
        Route::post('/categories/update',[categoryController::class,'update'])->name('categories.update');
    });
});
