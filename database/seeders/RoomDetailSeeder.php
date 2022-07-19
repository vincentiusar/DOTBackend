<?php

namespace Database\Seeders;

use App\Models\RoomDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // RoomDetail::factory()->count(10)->create();

        DB::table('RoomDetails')->insert([
            "name"=>"Kings Gambit",
            "price"=>"100000",
            "capacity"=>2,
            "description"=>"Chess Grandmaster Room",
            "image" => "https://www.ahstatic.com/photos/5451_ho_00_p_1024x768.jpg",
            "hotel_id"=>100,
            'created_at' => '2002-12-12 00:00:00',
            'updated_at' => '2002-12-12 00:00:00'
        ]);
    }
}
