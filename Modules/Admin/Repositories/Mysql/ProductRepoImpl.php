<?php

namespace Modules\Admin\Repositories\Mysql;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Admin\Contracts\Repositories\Mysql\ProductRepository;

class ProductRepoImpl implements ProductRepository
{

    public function getAllWithFilter(array $filters, $paginator = 20): LengthAwarePaginator
    {
        return Product::query()->where($filters)->orderByDesc('id')->paginate($paginator);
    }

    /** @noinspection PhpIncompatibleReturnTypeInspection */
    public function findById(int $productId): ?Product
    {
        return Product::query()->find($productId);
    }

    /**
     * @param Product $product
     * @return Product
     */
    public function save(Product $product): Product
    {
        $product->save();

        return $product;
    }

}
