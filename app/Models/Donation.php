<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'number_tree',
        'tree_type',
        'amount',
        'date_actualized',
        'date_donation',
        'donation_id',
        'transaction_id'

    ];
}
