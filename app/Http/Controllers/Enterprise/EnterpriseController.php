<?php

namespace App\Http\Controllers\Enterprise;

use App\Http\Controllers\Controller;
use App\Models\enterpriseSponsor;
use Illuminate\Http\Request;

class EnterpriseController extends Controller
{

    public function index()
    {

        $entities = enterpriseSponsor::all();
        return $entities;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $enterpriseSponor = enterpriseSponsor::find($id);
        return response()->json([
            'status' => 1,
            'massage' => 'Show is Successfully',
            'data' => $enterpriseSponor

        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $enterpriseSponsor = enterpriseSponsor::findOrFail($id);
        $enterpriseSponsor->update($request->all());
        return $enterpriseSponsor;


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        $enterpriseSponsor = enterpriseSponsor::findOrFail($id);
//        $enterpriseSponsor->delete();
        $enterpriseSponsor = enterpriseSponsor::destroy($id);
        return response()->setStatusCode('204');
    }
}
