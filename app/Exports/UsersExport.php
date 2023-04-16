<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    private array $filters;

    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    public function headings(): array
    {
        return [
            'Customer ID',
            'Customer name',
            'Phone number',
            'Birthday',
            'Email',
            'Gender',
            'Created_at',
            'Updated_at'
        ];
    }

    /**
     * @return Collection
     */
    public function collection(): Collection
    {
        return User::query()->where($this->filters)->get();
    }
}
