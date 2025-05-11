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
            Log::info('Exporting bill:', [
                'supplier' => $bill->supplier->company_name ?? '',
                'contract' => $bill->contract->contract_number ?? '',
                'worker' => $bill->createdBy->name ?? '',
                'amount' => $bill->amount,
            ]);

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
