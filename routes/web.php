<?php

use App\Http\Controllers\View\ApiViewController;
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

Route::get('/', [ApiViewController::class, 'landing']);

Route::get('/login', [ApiViewController::class, 'login']);
Route::post('/login', [ApiViewController::class, 'handleLogin']);

Route::get('/hotel', [ApiViewController::class, 'getHotels']);
Route::get('/hotel/{hotelId}', [ApiViewController::class, 'getHotelById']);
Route::group(['middleware' => ['auth:sanctum']], function () {
});