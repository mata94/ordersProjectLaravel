<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Log;

class BillsExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        $bills = \App\Models\Bill::with('supplier', 'contract', 'createdBy')->get();

        return $bills->map(function ($bill) {
            return [
                $bill->supplier->company_name ?? '',
                $bill->contract->contract_number ?? '',
                $bill->createdBy->name ?? '',
                $bill->amount,
            ];
        })->toArray();
    }

    public function headings(): array
    {
        return [
            'Supplier Name',
            'Contract Number',
            'Worker',
            'Amount',
        ];
    }
}
