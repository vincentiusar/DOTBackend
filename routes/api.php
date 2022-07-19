<?php

use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\Hotel\ApiHotelController;
use App\Http\Controllers\Room\ApiRoomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::post('/login', [ApiAuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/hotel', [ApiHotelController::class, 'getAllHotels']);
    Route::get('/hotel/{hotelid}', [ApiHotelController::class, 'getOneHotel']);
    Route::post('/hotel', [ApiHotelController::class, 'addHotel']);
    Route::put('/hotel', [ApiHotelController::class, 'updateHotel']);
    Route::delete('/hotel', [ApiHotelController::class, 'deleteHotel']);

    Route::get('/room/hotel/{hotelid}', [ApiRoomController::class, 'getAllRoomsByHotelId']);
    Route::get('/room/{id}', [ApiRoomController::class, 'getOneRoomById']);
    Route::post('/room', [ApiRoomController::class, 'addRoom']);
    Route::put('/room', [ApiRoomController::class, 'updateRoom']);
    Route::delete('/room', [ApiRoomController::class, 'deleteRoom']);
});
