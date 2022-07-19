<?php

namespace App\Http\Controllers\Hotel;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\RoomDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

class ApiHotelController extends Controller
{
    public function getAllHotels() {
        $hotel = Hotel::all();

        foreach ($hotel as $h) {
            $h['capacity'] = 0;
            $rooms = json_decode(DB::table("RoomDetails")->where('hotel_id', $h['id'])->get(), true);
            foreach ($rooms as $r) {
                $h['capacity'] += $r['capacity'];
            }
        }

        return response($hotel, 200);
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

        $hotel = Hotel::create($request->toArray());

        return response($hotel, 200);
    }

    public function updateHotel(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',Rule::unique('hotels')->ignore($request->id),
            'description' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        Hotel::where('id', $request->id)->update([
            'name' => $request['name'],
            'description' => $request['description'],
            'lat' => $request['lat'] == NULL ? "" : $request['lat'],
            'lot' => $request['lot'] == NULL ? "" : $request['lot'],
            'image' => $request['image'] == NULL ? "" : $request['image']
        ]);

        $hotel = Hotel::where('id', $request->id)->first();
        return response($hotel, 200);
    }

    public function getOneHotel($hotelid) {
        $hotel = Hotel::where('id', $hotelid)->first();

        $rooms = json_decode(DB::table('RoomDetails')->where('hotel_id', $hotelid)->get(), true);
        $hotel['capacity'] = 0;

        foreach ($rooms as $r) {
            $hotel['capacity'] += $r['capacity'];
        }

        return response($hotel, 200);
    }

    public function deleteHotel(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer|exists:hotels',
        ]);
        if ($validator->fails()) {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        
        $hotel = Hotel::where('id', $request->id)->first();
        $response["hotel"] = $hotel["name"];
        $response["message"] = "Hotel Deleted {$hotel['name']}";

        $hotel->delete();

        return response($response, 200);
    }
}