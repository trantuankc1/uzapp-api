<?php

namespace Modules\Api\Repositories\Mysql;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Modules\Api\Constants\ProductStatus;
use Modules\Api\Contracts\Repositories\Mysql\ProductRepository;

class ProductRepoImpl implements ProductRepository
{
    /**
     * @param array $filter
     * @return LengthAwarePaginator
     */
    public function productList(array $filter, int $paginate = 10): LengthAwarePaginator
    {
        return Product::query()->with('category')->where('status', ProductStatus::ACTIVE_STATUS)
            ->where($filter)
            ->paginate($paginate);
    }

    /**
     * @param int $id
     * @return Collection
     */
    public function productDetail(int $id): Collection
    {
        return Product::query()->where('id', $id)->get();
    }

    /**
     * @param int $categoryId
     * @return Collection
     */
    public function getByCateId(int $categoryId): Collection
    {
        return Product::query()
            ->with('category')
            ->where('category_id', $categoryId)
            ->get();
    }

    public function getAllWithFilter(array $filters, $paginator = 20): LengthAwarePaginator
    {
        return Product::query()->where($filters)->orderByDesc('id')->paginate($paginator);
    }

    public function getProductByIds(array $productIds): Collection
    {
        return Product::query()
            ->whereIn('id', $productIds)
            ->where('status', ProductStatus::ACTIVE_STATUS)
            ->get();
    }
}
