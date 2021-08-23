<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {

        $payments = Payment::with(['guaranteed', 'personal_sponsor'])->get();

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
