<?php

namespace App\Http\Controllers\Guaranteed;

use App\Http\Controllers\Controller;
use App\Models\Guaranteed;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PersonalSponsorGuaranteedController extends Controller
{

    public function index($id)
    {
        $guaranteeds = Guaranteed::where('personal_sponsor_id', '=', $id)->get();;
        return response()->json([
            'status' => 1,
            'data' => $guaranteeds,
            'massage' => 'successfully'
        ]);
    }

    public function store(Request $request, $id)
    {
        $add_date = Carbon::now()->format('y-m-d');
        $request->merge([
            'personal_sponsor_id' => $id,
            'add_data' => $add_date
        ]);

        $request->validate([
            'name' => 'required',
            'warranty_type' => 'required',
            'personal_sponsor_id' => 'required',
            'currency_id' => 'required',
            'add_data' => 'required',
            'money' => 'required'
        ]);

        $guaranteed = Guaranteed::create($request->all());

        return response()->json([
            'data' => $guaranteed,
            'message' => 'successfully'
        ]);
    }

    public function search(Request $request, $id)
    {

        $guaranteeds = Guaranteed::with(['personalSponsor'])
            ->where('personal_sponsor_id', '=', $id)
            ->orderByDesc('created_at');


        if (isset($request->warranty_type))
            $guaranteeds = $guaranteeds->where('warranty_type', 'like', '%' . $request->warranty_type . '%');

        if (isset($request->guaranteed_id))
            $guaranteeds = $guaranteeds->where('id', $request->guaranteed_id);

        $guaranteeds = $guaranteeds->get();

        return response()->json([
            'data' => $guaranteeds,
        ]);
    }


}
