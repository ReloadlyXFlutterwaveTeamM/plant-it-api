<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TreePlanted extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'coordinates',
        'name',
        'value',
        'donation_id',
    ];
}
