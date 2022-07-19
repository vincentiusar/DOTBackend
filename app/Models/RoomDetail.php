<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'price',
        'capacity',
        'description',
        'hotel_id',
        'image',
    ];
}
