<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\personalSponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index(Request $request)
    {

        $now = date('Y-m-d');

        $payments = Payment::with(['personal_sponsor'])
            ->withCount(['guaranteeds'])->withSum('guaranteeds', 'money');


        $payments = Payment::with(['personal_sponsor', 'guaranteeds' => function ($query) {
            $query->sum('money')
            ;
        }]);

//        $data = Payment::with(['guaranteed', 'personal_sponsor'])
//            ->join('personal_sponsors as p','personal_sponsor_id')
//            ->where();

//        Abc::selectSub(personalSponsor::select('count(*) as guaranteedNumber, ')->groupBy('col1'), 'a')->count('a.*');

        if (isset($request->id))
            $payments = $payments->where('id', $request->id);
        if (isset($request->bill_id))
            $payments = $payments->where('bill_id', $request->bill_id);

        if (isset($request->personal_sponsor_id))
            $payments = $payments->where('personal_sponsor_id', $request->personal_sponsor_id);

        if (isset($request->guaranteed_id))
            $payments = $payments->where('guaranteed_id', $request->guaranteed_id);

        if (isset($request->start))
            $payments = $payments
                ->whereBetween('start', [$request->start, $request->end ?? $now]);


        $payments = $payments->get();
        return response()->json([
            'payment' => $payments
        ]);

    }

    public function store(Request $request)
    {

    }

    public function update(Request $request)
    {
    }

    public function destroy($id)
    {

    }

    public function guaranteedPayments(Request $request)
    {


    }
}
