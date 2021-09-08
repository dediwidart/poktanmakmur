<?php

use App\Http\Controllers\ApiController;
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

Route::get('/category', [ApiController::class, 'category']);
Route::get('/banners', [ApiController::class, 'banner']);
Route::get('/faq', [ApiController::class, 'faq']);
Route::get('/products', [ApiController::class, 'product']);
Route::get('/ongkir', [ApiController::class, 'getRajaOngkir']);
Route::get('/ongkir-costs', [ApiController::class, 'getOngkirCost']);
Route::get('/nav-order', [ApiController::class, 'nav_order']);
Route::get('/find-phone', [ApiController::class, 'find_phone']);
Route::get('/agenda', [ApiController::class, 'agenda']);
Route::get('/search-agenda', [ApiController::class, 'search_agenda']);
Route::get('/material', [ApiController::class, 'material']);
Route::get('/search-material', [ApiController::class, 'search_material']);

Route::post('/login', [ApiController::class, 'login']);
Route::post('/register', [ApiController::class, 'register']);
Route::post('/account', [ApiController::class, 'account']);
Route::post('/order', [ApiController::class, 'order']);
Route::post('/order-handler', [ApiController::class, 'order_handler']);
Route::post('/search', [ApiController::class, 'search']);
Route::post('/password-update', [ApiController::class, 'passwordUpdate']);
Route::post('/address-update', [ApiController::class, 'addressUpdate']);
Route::post('/account-update', [ApiController::class, 'accountUpdate']);
Route::post('/security-update', [ApiController::class, 'securityUpdate']);
Route::post('/add-transaction', [ApiController::class, 'addTransaction']);
