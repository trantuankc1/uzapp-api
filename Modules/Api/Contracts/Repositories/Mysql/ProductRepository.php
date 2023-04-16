<?php

namespace Modules\Api\Contracts\Repositories\Mysql;


use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepository
{
    /**
     * @return LengthAwarePaginator
     */
    public function productList(array $filter, int $paginate = 10): LengthAwarePaginator;

    /**
     * @param int $id
     * @return Collection
     */
    public function productDetail(int $id): Collection;

    /**
     * @param int $categoryId
     * @return Collection
     */
    public function getByCateId(int $categoryId): Collection;

    public function getProductByIds(array $productIds): Collection;

}
