<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Validator;

class AuthController extends Controller
{
    public function signup(Request $request){

        	$validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'phone' => 'required|min:10|max:11',
                'email' => 'required|string|unique:users,email',
                'password' => 'required|string',
                'terms' => 'required|numeric'

            ]);        

         if (!$validator->fails()){

            $data=$request->all();
            $id = User::count() + 1;

            
            $user = User::create([
                'id' => $id,
                'name' => $data['name'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'terms' => $data['terms']
            ]);

            $token = $user->createToken('usertoken')->plainTextToken;

            $response = [
                'user' => $user,
                'token' => $token

            ];

            return response($response, 201);
        
        }else{

            return $validator->errors();

        }
}


    public function signin(Request $request){

    $validator = Validator::make($request->all(), [
        'email' => 'required|string',
        'password' => 'required|string'
        ]);        

     if (!$validator->fails())
       {

        $data=$request->all();

        // Check email
        $user = User::where('email', $data['email'])->first();

        // Check password
        if(!$user || !Hash::check($data['password'], $user->password)) {
            return response([
                'message' => 'Email or Password is incorrect'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }else{
        return $validator->errors();
    }
    
    }

    public function logout(){
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
}
