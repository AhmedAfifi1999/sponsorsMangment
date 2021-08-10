<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\personalSponsor;
use Illuminate\Http\Request;

class PersonalSposorController extends Controller
{

    public function __construct()
    {
        //  $this->middleware('admin');

    }

    public function index()
    {
        $personalSponors = personalSponsor::get();

        return response()->json([
            'status' => 1,
            'massage' => 'Show is Successfully',
            'data' => $personalSponors

        ]);
    }

    public function show($id)
    {

        $personalSponor = personalSponsor::find($id);
        return response()->json([
            'status' => 1,
            'massage' => 'Show is Successfully',
            'data' => $personalSponor

        ]);
    }

    public function update(Request $request, $id)
    {

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


    }

}
