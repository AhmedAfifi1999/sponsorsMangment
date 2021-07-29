<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\enterpriseSponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class register extends Controller
{

    public function index()
    {

        $counties = Country::all();

        return view('register', compact('counties'));
    }

    public function register(Request $request)
    {
        $entrpise = new enterpriseSponsor();

        $validator = Validator::make
        ($request->all(),$entrpise->validator() ,$entrpise->message());
        if ($validator->fails()){
            return response()->json([
                'status'=>0,
                'msg',$validator->errors()
            ]);
        }

        $entrpise->name = $request->name;
        $entrpise->contact_person = $request->contact_person;
        $entrpise->address = $request->address;
        $entrpise->first_telephone = $request->first_telephone;
        $entrpise->sec_telephone = $request->sec_telephone;
        $entrpise->email = $request->email;
        $entrpise->country_id = $request->country_id;
        $entrpise->password = bcrypt($request->password);

        $entrpise->save();

        // $entrpise_Sposor = enterpriseSponsor::create($request->toArray());


        return redirect('/');
     /*   return response()->json([
            'status' => 1,
            'massage' => 'register is successfully'

        ], 201);*/
    }


}
