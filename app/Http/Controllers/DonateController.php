<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DonateController extends Controller
{
    public function test(){
        return dd(auth()->user()->id);
    }
}
