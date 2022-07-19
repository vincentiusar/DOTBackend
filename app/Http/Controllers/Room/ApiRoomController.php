<?php

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ApiRoomController extends Controller
{
    public function getAllRoomsByHotelId(Request $request,$hotelId){
        $rooms = json_decode(DB::table('RoomDetails')->where('hotel_id',$hotelId)->get());

        return response($rooms, 200);
    }

    public function getOneRoomById(Request $request,$id){
        $request['id'] = $id;
        $validator = Validator::make($request->all(), [ 'id' => 'required|integer|exists:RoomDetails']);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $room = json_decode(DB::table('RoomDetails')->where('id', $id)->get(), true)[0];

        return response($room, 200);
    }

    public function addRoom(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|string',
            'capacity' => 'required|integer',
            'description' => 'required|string',
            'image' => 'required|string',
            'hotel_id' => 'required|exists:hotels,id', 
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $roomDetails = json_decode(DB::table('RoomDetails')->insertGetId($request->toArray()));
        $roomDetails = json_decode(DB::table('RoomDetails')->where('id', $roomDetails)->get(), true)[0];
        return response($roomDetails,200);
    }

    public function updateRoom(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer|exists:RoomDetails,id',
            'name' => 'required|string|max:255',
            'price' => 'required|string',
            'capacity' => 'required|integer',
            'description' => 'required|string',
            'image' => 'required|string',
            'hotel_id' => 'required|exists:hotels,id',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $roomDetails = json_decode(DB::table('RoomDetails')->where('id', $request->id)
                ->update([
                    'name' => $request['name'],
                    'price' => $request['price'],
                    'description' => $request['description'],
                    'image' => $request['image'],
                ]));

        $roomDetails = json_decode(DB::table('RoomDetails')->where('id', $request['id'])->get(), true)[0];

        return response($roomDetails, 200);
    }

    public function deleteRoom(Request $request) {

        $validator = Validator::make($request->all(), [
            'id' => 'required|integer|exists:RoomDetails',
        ]);
        if ($validator->fails()) {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        
        $room = json_decode(DB::table('RoomDetails')->where('id', $request->id)->get(), true)[0];
        $response["room"] = $room["name"];
        $response["message"] = "Room Deleted {$room['name']}";

        DB::table('RoomDetails')->where('id', $request->id)->delete();

        return response($response, 200);
    }
}
