<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements  FromCollection, WithHeadings
{
    private array $filters;

    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    public function headings():array
    {
        return [
            'id',
            'category',
            'code',
            'name',
            'thumbnail',
            'price',
            'price_tax_in',
            'inventory',
            'description',
            'display_order',
            'tax',
            'quantity',
            'status',
            'created_by_id',
            'created_at',
            'updated_at'
        ];
    }

    /**
    * @return Collection
    */
    public function collection(): Collection
    {
        return Product::query()->where($this->filters)->get();
    }
}
