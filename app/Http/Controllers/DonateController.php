<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\Transanction;
use App\Models\Point;
use App\Models\TreePlanted;
use Validator;
use Auth;

class DonateController extends Controller
{
    public function donations(Request $request){
        $validator = Validator::make($request->all(), [
            'number_tree' => 'required|numeric',
            'tree_type' => 'required|string',
            'date_actualized' => 'nullable',
            'date_donation' => 'required',
            'planting_area.coordinates' => 'required',
            'planting_area.name' => 'required',
            'planting_area.value' => 'required',
            'amount' => 'required|numeric',
            'currency' =>'required',
            'status' =>'required',
            'points.earned' => 'required',
            'points.redeemed' => 'required',
            'tx_ref' =>'required',
            'flw_ref' =>'required',
            'transanction_id' =>'required',
            'donation_id' =>'required'
        ]);

       

        if (!$validator->fails()){

            $data=$request->all();
            $user_id = Auth::user()->id;

            $donation = Donation::create([
                'user_id' => $user_id,
                'number_tree' => $data['number_tree'],
                'tree_type' => $data['tree_type'],
                'amount' => $data['amount'],
                'date_actualized' => $data['date_actualized'],
                'date_donation' => $data['date_donation'],
                'donation_id' => $data['donation_id'],
                'transaction_id' => $data['transanction_id']
            ]);

            $points = Point::create([
                'user_id' => $user_id,
                'earned' => $data['points']['earned'],
                'redeemed' => $data['points']['redeemed'],
                'donation_id' => $data['donation_id'],
            ]);

            $planted = TreePlanted::create([
                'user_id' => $user_id,
                'coordinates' => json_encode($data['planting_area']['coordinates']),
                'name' => $data['planting_area']['name'],
                'value' => $data['planting_area']['value'],
                'donation_id' => $data['donation_id']
            ]);

            $transanction = Transanction::create([
                'user_id' => $user_id,
                'amount' => $data['amount'],
                'currency' => $data['currency'],
                'flw_ref' => $data['flw_ref'],
                'status' => $data['status'],
                'tx_ref' => $data['tx_ref'],
                'transanction_id' => $data['transanction_id']
            ]);

           

            $response = "Donation Successful";

            return response($response, "201");
        
        }else{

            return $validator->errors();

        }


    }
}
