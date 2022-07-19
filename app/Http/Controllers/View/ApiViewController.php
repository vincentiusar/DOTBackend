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
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ApiViewController extends Controller
{
    public function tokenCheck(Request $request) {
        if ($request->session()->get('token') == null) {
            return false;
        }
        return true;
    }

    public function landing() {
        return response()->view('welcome');
    }

    public function login() {
        return response()->view('login');
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

    public function viewAddHotel(Request $request) {
        if (!$this->tokenCheck($request)) return redirect('/login');
        return response()->view('addHotel');
    }

    public function viewUpdateHotel(Request $request, $hotelId) {
        if (!$this->tokenCheck($request)) return redirect('/login');
        try {
            $hotel = Hotel::where('id', $hotelId)->first();
        } catch (Exception $e) {
            report($e);
        }
        return response()->view('updateHotel', ['hotel' => $hotel]);
    }

    public function viewAddRoom(Request $request, $hotelId) {
        if (!$this->tokenCheck($request)) return redirect('/login');
        return response()->view('addRoom', ['hotelId' => $hotelId]);
    }

    public function viewUpdateRoom(Request $request, $roomId) {
        if (!$this->tokenCheck($request)) return redirect('/login');

        try {
            $room = DB::table('RoomDetails')->where('id', $roomId)->get();
            $room = json_decode($room, true)[0];
        } catch (Exception $e) {
            report($e);
        }

        return response()->view('updateRoom', ['room' => $room]);
    }

    public function getHotels(Request $request) {
        if (!$this->tokenCheck($request)) return redirect('/login');
        try {
            $hotels = Hotel::all();
        } catch (Exception $e) {
            report($e);
        }

        return response()->view('/hotels', ['hotels' => $hotels]);
    }

    public function getHotelById(Request $request, $hotelId) {
        if (!$this->tokenCheck($request)) return redirect('/login');

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
        if (!$this->tokenCheck($request)) return redirect('/login');

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
        if (!$this->tokenCheck($request)) return redirect('/login');

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

    public function deleteHotel(Request $request, $hotelId) {
        if (!$this->tokenCheck($request)) return redirect('/login');

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

    public function updateRoom(Request $request) {
        if (!$this->tokenCheck($request)) return redirect('/login');

        $validator = Validator::make($request->all(), [
            'id' => 'required|integer|exists:RoomDetails,id',
            'name' => 'required|string|max:255',
            'price' => 'required|string',
            'capacity' => 'required|integer',
            'description' => 'required|string',
            'hotel_id' => 'required|exists:hotels,id',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $roomDetails = DB::table('RoomDetails')->where('id', $request->id)
                    ->update(
                        [
                            'name' => $request['name'],
                            'price' => $request['price'],
                            'description' => $request['description'],
                        ]
                    );

        return redirect('/hotel/'.$request['hotel_id']);
    }

    public function addRoom(Request $request) {
        if (!$this->tokenCheck($request)) return redirect('/login');

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|string',
            'capacity' => 'required|integer',
            'description' => 'required|string',
            'hotel_id' => 'required|exists:hotels,id', 
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $roomDetails = DB::table('RoomDetails')->insert(
            [
                'name' => $request['name'],
                'price' => $request['price'],
                'capacity' => $request['capacity'],
                'description' => $request['description'],
                'image' => 'https://www.ahstatic.com/photos/5451_ho_00_p_1024x768.jpg',
                'hotel_id' => $request['hotel_id']
            ]
        );

        return redirect('/hotel/'.$request['hotel_id']);
    }

    public function deleteRoom(Request $request, $hotelId, $roomId) {
        if (!$this->tokenCheck($request)) return redirect('/login');

        $validator = Validator::make(['id' => $roomId], [
            'id' => 'required|integer|exists:RoomDetails',
        ]);
        if ($validator->fails()) {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        
        DB::table('RoomDetails')->where('id', $roomId)->delete();

        return redirect('/hotel/'.$hotelId);
    }

    public function searchHotel(Request $request) {
        if (!$this->tokenCheck($request)) return redirect('/login');
        try {
            $hotels = Hotel::whereRaw('lower(name) like (?) ', ['%'.strtolower($request['name']).'%'])->get();
        } catch (Exception $e) {
            report($e);
        }

        return response()->view('/hotels', ['hotels' => $hotels]);
    }
}
