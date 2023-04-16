<?php

namespace Modules\Api\Contracts\Services;


use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface ProductService
{
    public function getList(Request $request): LengthAwarePaginator;

    /**
     * @param int $id
     * @return Collection
     */
    public function productDetail(int $id):Collection;


    public function getProductByCategoryId(int $categoryId): bool|LengthAwarePaginator|Collection;

}
