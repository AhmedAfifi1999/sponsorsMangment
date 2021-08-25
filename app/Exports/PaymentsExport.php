<?php

namespace App\Exports;

use App\Models\Payment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PaymentsExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $payments = Payment::with(['personal_sponsor'])
            ->withCount(['guaranteeds'])->withSum('guaranteeds', 'money');
        return $payments->get();
    }

    public function headings(): array
    {
        return [
            'Bill id',
            'Date',
            'Personal Sponsor Id',
            'Total Money',
            'Number Of Guaranteed',
        ];
    }

    public function map($payments): array
    {
        return [
            $payments->bill_id,
            $payments->start,
            $payments->personal_sponsor_id,
            $payments->guaranteeds_sum_money,
            $payments->guaranteeds_count
        ];
    }

}
