<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\Transanction;
use Validator;
use Auth;

class DonateController extends Controller
{
    public function donations(Request $request){
        $validator = Validator::make($request->all(), [
            'number' => 'required',
            'location' => 'required',
            'type' => 'required|string',
            'amount' => 'required|numeric',
            'points_earned' => 'required|numeric',
            'status' => 'required',
            'ref_id' =>'required',
            'tran_id' =>'required'
        ]);

        if (!$validator->fails()){

            $data=$request->all();
            $user_id = Auth::user()->id;
            
            $donation = Donation::create([
                'user_id' => $user_id,
                'number' => $data['number'],
                'location' => $data['location'],
                'type' => $data['type'],
                'amount' => $data['amount'],
                'points_earned' => $data['points_earned'],
                'status' => $data['status']
            ]);

            $transanction = Transanction::create([
                'user_id' => $user_id,
                'tran_id' => $data['tran_id'],
                'ref_id' => $data['ref_id']
            ]);

            $response = "Donation Successful";

            return response($response, "201");
        
        }else{

            return $validator->errors();

        }


    }
}
