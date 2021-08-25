<?php

namespace App\Exports;

use App\Models\Guaranteed;
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
//        $guaranteeds = Payment::with(['personal_sponsor'])
//            ->withCount(['guaranteeds'])->withSum('guaranteeds', 'money');

        $guaranteeds = Guaranteed::with(['payment','currency']);
        return $guaranteeds->get();
    }

    public function headings(): array
    {
        return [
            'Bill id',
            'Date',
            'Personal Sponsor Id',
            'Money',
            'currency',
            'Guaranteed ID',
            'Guaranteed Name',
        ];
    }

    public function map($guaranteeds): array
    {
        return [
            $guaranteeds->payment->bill_id,
            $guaranteeds->payment->start,
            $guaranteeds->payment->personal_sponsor_id,
            $guaranteeds->money,
            $guaranteeds->currency->name,
            $guaranteeds->id,
            $guaranteeds->name
        ];
    }

}
