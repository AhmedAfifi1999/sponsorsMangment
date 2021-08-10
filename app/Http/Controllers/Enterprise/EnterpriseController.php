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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


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
        return enterpriseSponsor::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $enterpriseSponsor = enterpriseSponsor::findOrFail($id);
        $enterpriseSponsor->delete();

        return response()->setStatusCode('204');
    }
}
