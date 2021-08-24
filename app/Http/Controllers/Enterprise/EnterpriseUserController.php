<?php

namespace App\Http\Controllers\Enterprise;

use App\Http\Controllers\Controller;
use App\Models\enterpriseSponsor;
use Illuminate\Http\Request;

class EnterpriseUserController extends Controller
{
    public function register(Request $request)
    {


        $request->validate([
            'name' => 'required',
            'contact_person' => 'required',
            'address' => 'required',
            'first_telephone' => 'required',
            'sec_telephone' => 'required',
            'country_id' => 'required',
            'email' => 'required|email|unique:enterprise_sponsors,id',
            'password' => 'required|confirmed'

        ]);
        $email = enterpriseSponsor::where('email', $request->email)->first();
        if ($email) {
            return response()->json(
                ['status' => 0,
                    'massage' => 'duplicate Email']
                , 419);
        }

        $user = new enterpriseSponsor();
        $user->name = $request->name;
        $user->contact_person = $request->contact_person;
        $user->address = $request->address;
        $user->first_telephone = $request->first_telephone;
        $user->sec_telephone = $request->sec_telephone;
        $user->country_id = $request->country_id;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();
        return response()->json(
            ['status' => 1,
                'massage' => 'Success register']
            , 201);

    }
}

