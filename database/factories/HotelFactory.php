<?php

namespace Database\Factories;

use App\Models\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class HotelFactory extends Factory
{
    protected $model = Hotel::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name" => $this->faker->name() . " hotel",
            "description" => $this->faker->sentence(),
            "image" => "https://firebasestorage.googleapis.com/v0/b/hotelist-447e9.appspot.com/o/11322e42e9bc8102.jpg?alt=media&token=579720c3-3c96-4186-b4a6-997e6b45663a"
        ];
    }
}
