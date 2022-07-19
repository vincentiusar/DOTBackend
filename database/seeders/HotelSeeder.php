<?php

namespace Database\Seeders;

use App\Models\Hotel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Hotel::factory()->count(10)->create();

        DB::table('hotels')->insert([
            'id' => 100,
            'name' => "OYO Hotel",
            "description"=> 'Lokasi\nRasakan pengalaman terbaik liburan Anda di Bandung di OYO 1446 Patradisa Hotel, hanya 1,5 km dari Taman Balai Kota Bandung dan dalam jarak berjalan kaki ke toko-toko dan kafe lokal, terhubung dengan baik oleh transportasi umum dan pribadi karena kedekatannya dengan area sibuk kota. Sebuah gereja bersejarah, Katedral St. Peter berjarak 1 km, dan negara bagian Gedung Bersejarah berjarak 2,3 km.\n\nFitur Khusus\nProperti ini memiliki pesona kamar yang simpel dan luas, yang menjanjikan Anda ketenangan dan kenyamanan selama berlibur ke Kota Bandung. Properti ini memiliki interior modern dan dilengkapi dengan kebutuhan untuk masa inap yang santai.\n\nFasilitas\nMeskipun, properti ini adalah pilihan yang tepat untuk perjalanan ke Bandung karena kedekatannya dengan area pasar, namun juga menarik bagi wisatawan dengan fasilitasnya yang sederhana. Kamar-kamarnya memiliki AC, WiFi, TV kabel, dan fasilitas kamar mandi pribadi. Para tamu memiliki akses ke fasilitas parkir, layanan binatu dan lobi umum.\n\nTerdekat\nPerkebunan teh dan gunung berapi yang spektakuler menjadikan Kota Bandung di Jawa Barat menarik ribuan wisatawan. Bandung juga merupakan tujuan belanja terkenal dengan banyak gerai mode yang tersebar di seluruh kota. Beberapa tempat perbelanjaan terkenal adalah Braga City Walk, Bandung Indah Plaza, Istana BEC dan Balubur Town Square, terletak di dekatnya. Bandara terdekat, Bandara Husein Sastranegara berjarak 4 km dan stasiun kereta terdekat, Stasiun Bandung berjarak 1,5 km.',
            "lat"=> "-6.9123556",
            "lot"=> "107.6087814",
            "image"=> "https://firebasestorage.googleapis.com/v0/b/hotelist-447e9.appspot.com/o/11322e42e9bc8102.jpg?alt=media&token=579720c3-3c96-4186-b4a6-997e6b45663a",
            'created_at' => '2002-12-12 00:00:00',
            'updated_at' => '2002-12-12 00:00:00'
        ]);
    }
}
