<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\RoomDetail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ApiViewController extends Controller
{
    public function landing() {
        return response()->view('welcome');
    }

    public function login() {
        return response()->view('login');
    }

    public function viewAddHotel(Request $request) {
        return response()->view('addHotel');
    }

    public function viewUpdateHotel($hotelId) {
        try {
            $hotel = Hotel::where('id', $hotelId)->first();
        } catch (Exception $e) {
            report($e);
        }
        return response()->view('updateHotel', ['hotel' => $hotel]);
    }

    public function handleLogin(Request $request) {
        $req = ['username' => $request->all()['username'], 'password' => $request->all()['password']];
        $validator = Validator::make($req, [
            'username' => 'required|string|max:255|exists:users',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails())
        {
            return redirect('/login');
        }
        
        $user = User::where('username', $req['username'])->first();
        if ($user) {
            if (Hash::check($req['password'], $user['password'])) {
                $response['user'] = $user;
                $response['token'] = $user->createToken('TokenHotel')->plainTextToken;
                $session = $request->session()->put('token', $response['token']);

                return redirect('/hotel')->withHeaders(['Authorization', 'Bearer ' . $response['token']]);
            }
        } else {
            $response = ["message" => 'Unauthenticated'];
            return redirect('/login');
        }
    }

    public function getHotels() {
        try {
            $hotels = Hotel::all();
        } catch (Exception $e) {
            report($e);
        }

        return response()->view('/hotels', ['hotels' => $hotels]);
    }

    public function getHotelById($hotelId) {
        try {
            $hotel = Hotel::where('id', $hotelId)->first();
            $rooms = DB::table('RoomDetails')->select('*')->where('hotel_id', $hotelId)->get();
            
            $rooms = json_decode($rooms, true);
        } catch (Exception $e) {
            report($e);
        }

        return response()->view('/hotel', ['hotel' => $hotel, 'rooms' => $rooms]);
    }

    public function addHotel(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:hotels',
            'description' => 'required|string',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $request['image'] = 'https://www.ahstatic.com/photos/5451_ho_00_p_1024x768.jpg';
        $hotel = Hotel::create($request->toArray());

        return redirect('/hotel');
    }

    public function updateHotel(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',Rule::unique('hotels')->ignore($request->id),
        ]);
        if ($validator->fails()) {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $hotel = Hotel::where('id', $request->id)->first();
        $hotel['name'] = $request['name'];
        $hotel['description'] = $request['description'];
        $hotel['lat'] = $request['lat'] == NULL ? "" : $request['lat'];
        $hotel['lot'] = $request['lot'] == NULL ? "" : $request['lot'];

        $hotel->save();

        return redirect('/hotel/'.$hotel['id']);
    }

    public function deleteHotel($hotelId) {
        $validator = Validator::make(['id' => $hotelId], [
            'id' => 'required|integer|exists:hotels',
        ]);
        if ($validator->fails()) {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        
        $hotel = Hotel::where('id', $hotelId)->first();
        $response["hotel"] = $hotel["name"];
        $response["message"] = "Hotel Deleted {$hotel['name']}";

        $hotel->delete();

        return redirect('/hotel');
    }
}
