<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\Faq;
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

Route::get('/', function(){return redirect('/dashboard');});
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/login', function(){return view('login');});
Route::get('/logout', [DashboardController::class, 'logout']);
Route::get('/order/{status}', [OrderController::class, 'index']);
Route::get('/order/detail/{id}', [OrderController::class, 'detail']);
Route::get('/order/printpdf/{id}', [OrderController::class, 'printpdf']);
Route::get('/order/send/{id}', [OrderController::class, 'send']);
Route::get('/order/end/{id}', [OrderController::class, 'end']);
Route::get('/order/cancel/{id}', [OrderController::class, 'cancel']);
Route::get('/product', [ProductController::class, 'index']);
Route::get('/product/create', [ProductController::class, 'form']);
Route::get('/product/edit/{id}', [ProductController::class, 'edit']);
Route::get('/product/delete/{id}', [ProductController::class, 'destroy']);
Route::get('/category', [CategoryController::class, 'index']);
Route::get('/category/create', [CategoryController::class, 'form']);
Route::get('/category/edit/{id}', [CategoryController::class, 'edit']);
Route::get('/category/delete/{id}', [CategoryController::class, 'destroy']);
Route::get('/banner', [BannerController::class, 'index']);
Route::get('/banner/create', [BannerController::class, 'form']);
Route::get('/banner/delete/{id}', [BannerController::class, 'destroy']);
Route::get('/material', [MaterialController::class, 'index']);
Route::get('/material/edit/{id}', [MaterialController::class, 'show']);
Route::get('/material/create', [MaterialController::class, 'create']);
Route::get('/material/delete/{id}', [MaterialController::class, 'destroy']);
Route::get('/agenda', [AgendaController::class, 'index']);
Route::get('/agenda/edit/{id}', [AgendaController::class, 'show']);
Route::get('/agenda/create', [AgendaController::class, 'create']);
Route::get('/agenda/delete/{id}', [AgendaController::class, 'destroy']);
Route::get('/faq', [FaqController::class, 'index']);
Route::get('/faq', [FaqController::class, 'index']);
Route::get('/faq/edit/{id}', [FaqController::class, 'edit']);
Route::get('/faq/delete/{id}', [FaqController::class, 'destroy']);
Route::get('/faq/create', [FaqController::class, 'form']);
Route::get('/user', [UserController::class, 'index']);
Route::get('/user/delete/{id}', [UserController::class, 'destroy']);
Route::get('/config', [ConfigController::class, 'index']);

Route::post('/login', [DashboardController::class,'login']);
Route::post('/product/edit/{id}', [ProductController::class, 'update']);
Route::post('/product/create', [ProductController::class, 'store']);
Route::post('/category/create', [CategoryController::class, 'store']);
Route::post('/category/edit/{id}', [CategoryController::class, 'update']);
Route::post('/banner/create', [BannerController::class, 'store']);
Route::post('/faq/edit/{id}', [FaqController::class, 'update']);
Route::post('/faq/create', [FaqController::class, 'store']);
Route::post('/config', [ConfigController::class, 'update']);
Route::post('/material/create', [MaterialController::class, 'store']);
Route::post('/material/edit/{id}', [MaterialController::class, 'update']);
Route::post('/agenda/create', [AgendaController::class, 'store']);
Route::post('/agenda/edit/{id}', [AgendaController::class, 'update']);