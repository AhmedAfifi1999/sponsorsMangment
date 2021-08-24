<?php

namespace App\Http\Controllers;

use App\Models\GuaranteedPayment;
use Illuminate\Http\Request;

class GuaranteedPaymentController extends Controller
{

    public function index(Request $request)
    {

        $Payments = GuaranteedPayment::with(['currency', 'guaranteed']);
        return response()->json([
            'Payments' => $Payments
        ]);
    }


}
