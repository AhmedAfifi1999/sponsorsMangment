<?php

namespace App\Http\Controllers;

use App\Exports\PaymentsExport;
use App\Models\Payment;
use App\Models\personalSponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class PaymentController extends Controller
{
    public function index(Request $request)
    {

        $now = date('Y-m-d');

        $payments = Payment::with(['personal_sponsor'])
            ->withCount(['guaranteeds'])->withSum('guaranteeds', 'money');

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

        $request->validate([
            'bill_id' => 'required|int',
            'enterprise_sponsor_id' => 'nullable|int',
            'personal_sponsor_id' => 'required|int',
            'start' => 'nullable|date',
            'end' => 'nullable|date',
            'guaranteed_id' => 'nullable|int'
        ]);

        if (!isset($request->start)) {
            $now = date('Y-m-d');
            $request->merge(['start' => $now]);
        }


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

    public function exprot(Request $request)
    {

        return Excel::download(new PaymentsExport, 'Payments.xlsx');

    }
}
