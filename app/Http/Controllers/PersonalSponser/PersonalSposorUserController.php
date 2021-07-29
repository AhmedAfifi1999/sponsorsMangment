<?php

namespace App\Http\Controllers\PersonalSponser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\personalSponsor;
use mysql_xdevapi\Exception;

class PersonalSposorUserController extends Controller
{
    public function register(Request $request)
    {
        $users = new personalSponsor();

        $request->validate([
            'city_id'=>'required',
            'country_id'=>'required',
            'details'=>'required',
            'first_name'=>'required',
            'governorate_id'=>'required',
            'identification_number'=>'required',
            'identification_number_type'=>'required',
            'last_name'=>'required',
            'nationality_id'=>'required',
            'neighborhood_id'=>'required',
            'phone_number'=>'required',
            'sec_name'=>'required',
            'third_name'=>'required',
            'telephone'=>'required',
            'email' => 'required|email|unique:personal_sponsors',
            'password' => 'required|confirmed'

        ]);

        $user = new personalSponsor();
        $user->first_name = $request->first_name;
        $user->sec_name = $request->sec_name;
        $user->third_name = $request->third_name;
        $user->last_name = $request->last_name;

        $user->governorate_id = $request->governorate_id;
        $user->city_id = $request->city_id;
        $user->neighborhood_id = $request->neighborhood_id;
        $user->nationality_id = $request->nationality_id;
        $user->country_id	 = $request->country_id	;
        $user->details = $request->details;
        $user->phone_number	 = $request->phone_number;
        $user->telephone = $request->telephone;
        $user->identification_number = $request->identification_number;
        $user->identification_number_type = $request->identification_number_type;


        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();
        return response()->json(
            ['status' => 1,
                'massage' => 'Success register']
            , 201);

    }

    public function login(Request $request)
    {


            $request->validate([
                'email' => 'required',
                'password' => 'required'
            ]);

        if (!$token = auth('personal_sponsor')->attempt(["email" => $request->email, "password" => $request->password])) {
            return response()->json([
                'status' => 0,
                'message' => 'Invalid Credentials'
            ], 400);

        }

        return response()->json(
            ['status' => 1,
                'massage' => 'Success Login',
                'access_token' => $token
            ]
            , 200);


    }

    //-GET

    public function profile()
    {
        $user_data = auth('personal_sponsor')->user();

        return response()->json([
            'status' => 1,
            'massage' => 'user profile data',
            'data' => $user_data

        ]);


    }

    //-GET
    public function logout()
    {
        auth('personal_sponsor')->logout();
        return response()->json([
            'status' => 1,
            'massage' => 'User logged out'
        ]);
    }
}
