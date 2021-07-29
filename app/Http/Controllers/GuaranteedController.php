<?php

namespace App\Http\Controllers;

use App\Models\guaranteed;
use Illuminate\Http\Request;

class GuaranteedController extends Controller
{

    public function index()
    {
        $guaranteeds = guaranteed::all();

        return response()->json([
            'status' => 1,
            'massage' => 'get guaranteed is Successfully',
            'data' => $guaranteeds
        ]);
    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //Need Validation >>
        try {
            $guaranteeds = guaranteed::create([
                'name' => $request->name,
                'warranty_type' => $request->warranty_type,
                'add_data' => $request->add_data,
                'currency' => $request->currency,
                'money' => $request->money
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'massage' => 'Some this wrong happen'
            ], 400);

        }
        return response()->json([
            'status' => 1,
            'massage' => 'Store a new guaranteed is Successfully',
            'data' => $guaranteeds
        ], 201);


    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\guaranteed $guaranteed
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $guaranteeds = guaranteed::find($id);

        return response()->json([
            'status' => 1,
            'massage' => 'Show a new guaranteed is Successfully',
            'data' => $guaranteeds

        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\guaranteed $guaranteed
     * @return \Illuminate\Http\Response
     */
    public function edit(guaranteed $guaranteed)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\guaranteed $guaranteed
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $guaranteed = guaranteed::find($request->id);
        //$data = guaranteed::whereId($request->id)->update($request->all());
        $data = $guaranteed->update($request->all());

        return response()->json([
            'massage' => 'Update is Successfully',
            'data' => $guaranteed
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\guaranteed $guaranteed
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $guaranteed = guaranteed::find($id);
        $result = $guaranteed->delete();

    }
}
