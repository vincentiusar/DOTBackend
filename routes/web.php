<?php

use App\Http\Controllers\RoomDetails\ApiRoomController;
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
Route::get('/addhotel', [ApiViewController::class, 'viewAddHotel']);
Route::get('/updatehotel/{hotelId}', [ApiViewController::class, 'viewUpdateHotel']);
Route::post('/hotel', [ApiViewController::class, 'addHotel']);
Route::put('/hotel', [ApiViewController::class, 'updateHotel']);
Route::delete('/hotel/{hotelId}', [ApiViewController::class, 'deleteHotel']);

Route::get('/updateroom/{roomId}', [ApiViewController::class, 'viewUpdateRoom']);
Route::get('/addroom/{hotelId}', [ApiViewController::class, 'viewAddRoom']);
Route::post('/room', [ApiViewController::class, 'addRoom']);
Route::put('/room', [ApiViewController::class, 'updateRoom']);
Route::delete('{hotelId}/room/{roomId}', [ApiViewController::class, 'deleteRoom']);
