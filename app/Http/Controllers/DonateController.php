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
            'number_of_trees' => 'required|numeric',
            'tree_type' => 'required|string',
            'date_actualized' => 'nullable',
            'date_of_donation' => 'required',
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
            'transaction_id' =>'required',
            'donation_id' =>'required'
        ]);

       

        if (!$validator->fails()){

            $data=$request->all();
            $user_id = Auth::user()->id;

            $donation = Donation::create([
                'user_id' => $user_id,
                'number_of_trees' => $data['number_of_trees'],
                'tree_type' => $data['tree_type'],
                'amount' => $data['amount'],
                'date_actualized' => $data['date_actualized'],
                'date_of_donation' => $data['date_of_donation'],
                'donation_id' => $data['donation_id'],
                'transaction_id' => $data['transaction_id']
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
                'transaction_id' => $data['transaction_id']
            ]);

           

            $response = "Donation Successful";

            return response($response, "201");
        
        }else{

            return $validator->errors();

        }


    }

    public function listDonations($user_id){
        $donations = Donation::select('user_id', 'date_actualized', 'date_of_donation', 'donation_id', 'number_of_trees', 'transaction_id', 'tree_type')->where('user_id', $user_id)->get();

        for($i = 0; $i < count($donations); $i++) {

            $points = Point::select('earned', 'redeemed')->where('donation_id', $donations[$i]['donation_id'])->get();
            $donations[$i]["points"] = $points[0];

            $planting_area = TreePlanted::select('coordinates', 'name', 'value')->where('donation_id', $donations[$i]['donation_id'])->get();
            $coordinates = json_decode($planting_area[$i]['coordinates']);

            $arr_cordinates = [
                floatval($coordinates[0]),
                floatval($coordinates[1])
            ];

            $plant_area = [
                'coordinates' => $arr_cordinates,
                'name' => $planting_area[$i]['name'], 
                'value' => $planting_area[$i]['value']
            ];

            $donations[$i]["planting_area"] = $plant_area;
        }

        return $donations;
    }
}
