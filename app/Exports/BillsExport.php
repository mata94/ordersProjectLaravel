<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Log;

class BillsExport implements FromArray, WithHeadings, WithColumnWidths
{
   /* public function array(): array
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
    }*/

    public function array(): array
    {

        $bills = \App\Models\Bill::with('supplier', 'contract.items', 'createdBy')->get();

        $rows = [];

        foreach ($bills as $bill) {
            $contract = $bill->contract;

            $rows[] = [
                'Supplier: ' . ($bill->supplier->company_name ?? ''),
                'Contract Number: ' . ($contract->contract_number ?? ''),
                'Worker: ' . ($bill->createdBy->name ?? ''),
                'Amount: ' . number_format($bill->amount, 2, ',', '') . ' KM'
            ];

            $rows[] = [
                 '','', '', '', '',
                'Item Name', 'Item Quantity', 'Item Price', 'Total'
            ];

            if ($contract && $contract->items->isNotEmpty()) {
                foreach ($contract->items as $item) {
                    $quantity = $item->pivot->quantity ?? 0;
                    $price = $item->pivot->price_per_unit ?? 0;
                    $total = $quantity * $price;

                    $rows[] = [
                        '', '', '', '', '',
                        $item->item_name ?? '',
                        $quantity,
                        number_format($price, 2, ',', ''),
                        number_format($total, 2, ',', '')
                    ];
                }
            } else {
                $rows[] = ['', '', '', '', '', '', '', 'No items found', '', '', '', ''];
            }

            $rows[] = [''];
        }

        return $rows;
    }

    public function headings(): array
    {
        return [];
    }

    public function columnWidths(): array
    {
        return [
            "A" => 25,
            "B" => 30,
            "C" => 15,
            "F" => 15,
            "G" => 15,
            "H" => 15,
        ];
    }
}
