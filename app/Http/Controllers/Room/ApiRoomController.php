<?php

namespace App\Http\Controllers\RoomDetails;

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
        $validator = Validator::make($request->all(), [ 'id' => 'required|integer|exists:room_details']);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $room = json_decode(DB::table('RoomDetails')->where('id', $id)->first());

        return response($room, 200);
    }

    public function addRoomDetails(Request $request){
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
        $roomDetails = json_decode(DB::table('RoomDetails')->create($request->toArray()));

        return response($roomDetails,200);
    }

    public function updateRoomDetails(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer|exists:room_details,id',
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
        $roomDetails = json_decode(DB::table('RoomDetails')->where('id', $request->id)->first());

        $roomDetails['name']=$request['name'];
        $roomDetails['price']=$request['price'];
        $roomDetails['description']=$request['description'];
        $roomDetails['image']=$request['image'];

        $roomDetails->save();

        return response($roomDetails, 200);
    }

    public function deleteRoomDetails(Request $request) {

        $validator = Validator::make($request->all(), [
            'id' => 'required|integer|exists:room_details',
        ]);
        if ($validator->fails()) {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        
        $room = json_decode(DB::table('RoomDetails')->where('id', $request->id)->first());
        $response["room"] = $room["name"];
        $response["message"] = "Room Deleted {$room['name']}";

        $room->delete();

        return response($response, 200);
    }
}
