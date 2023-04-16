<?php

namespace App\Exports;

use App\Models\TransactionProduct;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrderDetailExport implements FromCollection, WithHeadings, WithMapping
{
    use Exportable;

    private string $fileName = 'Transaction.csv';

    /*public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }*/

    public function map($transactionProduct): array
    {
        return [
            $transactionProduct->id,
            $transactionProduct->created_at->format('Y-m-d'),
            $transactionProduct->fee_type,
            $transactionProduct->user->person_name,
            $transactionProduct->product_pay_amount,
            $transactionProduct->product_id,
            $transactionProduct->product_name,
            $transactionProduct->product_origin_amount,
            $transactionProduct->product_quantity
        ];
    }

    public function headings(): array
    {
        return [
            "order Id",
            "Date Start order",
            "Status",
            "Customer Name",
            "Total Money",
            "Product ID",
            "Product Name",
            "Price",
            'Quantity'
        ];
    }

    public function collection(): Collection
    {
        return TransactionProduct::with('transaction', 'user', 'product')->get();
    }
}
