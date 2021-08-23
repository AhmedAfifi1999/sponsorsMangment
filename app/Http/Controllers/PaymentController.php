<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {

        $now=date('Y-m-d');
        $payments = Payment::with(['guaranteed', 'personal_sponsor']);

        if (isset($request->id))
            $payments = $payments->where('id', $request->id);
        if (isset($request->bill_id))
            $payments = $payments->where('bill_id', $request->bill_id);

        if (isset($request->personal_sponsor_id))
            $payments = $payments->where('personal_sponsor_id', $request->personal_sponsor_id);

        if (isset($request->start))
            $payments=$payments
                ->whereBetween('start', [$request->start, $request->end??$now]);


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
