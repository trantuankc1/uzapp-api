<?php

namespace Modules\Admin\Contracts\Repositories\Mysql;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ProductRepository
{
    public function getAllWithFilter(array $filters, LengthAwarePaginator $paginator);

    public function findById(int $productId): ?Product;

    public function save(Product $product): Product;

}
