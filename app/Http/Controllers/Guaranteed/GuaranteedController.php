<?php

namespace App\Http\Controllers\Guaranteed;

use App\Http\Controllers\Controller;
use App\Models\Guaranteed;
use Illuminate\Http\Request;

class GuaranteedController extends Controller
{

    public function index()
    {
        $guaranteeds = Guaranteed::all();

        return response()->json([
            'status' => 1,
            'data' => $guaranteeds,
            'massage' => 'successfully'
        ]);
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
        $request->validate([
            'name' => 'required',
            'warranty_type' => 'required',
            'personal_sponsor_id' => 'required',
            'currency_id' => 'required',
            'add_data' => 'required',
            'money' => 'required'
        ]);

        $guaranteed = new Guaranteed();
        $guaranteed->name = $request->name;
        $guaranteed->warranty_type = $request->warranty_type;
        $guaranteed->personal_sponsor_id = $request->personal_sponsor_id;
        $guaranteed->currency_id = $request->currency_id;
        $guaranteed->add_data = $request->add_data;
        $guaranteed->money = $request->money;

        $guaranteed->save();

        return response()->json([
            'status' => 1,
            'data' => $guaranteed,
            'massage' => 'successfully'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $guaranteed = Guaranteed::FindOrFail($id);

        return response()->json([
            'status' => 1,
            'data' => $guaranteed,
            'massage' => 'successfully'
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $guaranteed = Guaranteed::find($id);
        if($guaranteed!=null){
        return response()->json([
            'status' => 1,
            'data' => $guaranteed,
            'massage' => 'successfully'
        ]);
        }

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
        $request->validate([
            'name' => 'required',
            'warranty_type' => 'required',
            'personal_sponsor_id' => 'required',
            'currency_id' => 'required',
            'add_data' => 'required',
            'money' => 'required'
        ]);

        $guaranteed = Guaranteed::find($id);
        $guaranteed->name = $request->name;
        $guaranteed->warranty_type = $request->warranty_type;
        $guaranteed->personal_sponsor_id = $request->personal_sponsor_id;
        $guaranteed->currency_id = $request->currency_id;
        $guaranteed->add_data = $request->add_data;
        $guaranteed->money = $request->money;
        $guaranteed->save();

        return response()->json([
            'status' => 1,
            'data' => $guaranteed,
            'message' => 'Update successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $guaranteed = Guaranteed::find($id);
        if ($guaranteed != null) {
            $guaranteed->delete();
        } else {

            return response()->json([
                'status' => 0,
                'message' => 'Guaranteed Not Found'
            ], 404);
        }

        return response()->json([
            'status' => 1,
            'message' => 'deleted successfully'
        ], 204);
    }
}
