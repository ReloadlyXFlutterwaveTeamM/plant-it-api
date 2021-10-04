<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'number_of_trees',
        'tree_type',
        'amount',
        'date_actualized',
        'date_of_donation',
        'donation_id',
        'transaction_id'

    ];
}
