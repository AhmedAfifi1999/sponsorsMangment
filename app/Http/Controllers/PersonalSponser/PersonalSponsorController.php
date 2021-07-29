<?php

namespace App\Http\Controllers\PersonalSponser;

use App\Http\Controllers\Controller;
use App\Models\personalSponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersonalSponsorController extends Controller
{

    public function index()
    {
        $id = Auth::guard('personal_sponsor')->user()->id;

        $personalSponors = personalSponsor::get()->where('id', $id);

        return response()->json([
            'status' => 1,
            'massage' => 'Show is Successfully',
            'data' => $personalSponors
        ]);
    }

    public function update(Request $request)
    {
        $id = Auth::guard('personal_sponsor')->user()->id;

        $user = personalSponsor::find($id);
        $data = $user->update($request->all());
        if (!$data) {

            return response()->json([
                'status' => 0,
                'massage' => 'Update is Failed'
            ]);

        }

        return response()->json([
            'status' => 1,
            'massage' => 'Update is Successfully',
            'data' => $user
        ], 200);


        /* $user= personalSponsor::where('id',$id)->update([
             'first_name'=>$request->first_name,
             'sec_name'=>$request->sec_name,
             'third_name'=>$request->third_name,
             'last_name'=>$request->last_name,
             'governorate_id'=>$request->governorate_id,
             'city_id'=>$request->city_id,
             'neighborhood_id'=>$request->neighborhood_id,
             'nationality_id'=>$request->nationality_id,
             'country_id'=>$request->country_id,
             'details'=>$request->details,
             'phone_number'=>$request->phone_number,
             'telephone'=>$request->telephone,
             'email'=>$request->email,
             'identification_number'=>$request->identification_number,
             'identification_number_type'=>$request->identification_number_type
         ]);*/

    }

}
