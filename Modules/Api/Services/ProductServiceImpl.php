<?php

namespace Modules\Api\Services;

use App\Models\Product;
use App\Models\TransactionProduct;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Modules\Api\Constants\ProductStatus;
use Modules\Api\Contracts\Repositories\Mysql\CategoryRepository;
use Modules\Api\Contracts\Repositories\Mysql\ProductRepository;
use Modules\Api\Contracts\Services\ProductService;

class ProductServiceImpl implements ProductService
{
    public ProductRepository $productRepository;
    public CategoryRepository $categoryRepository;

    /**
     * @param ProductRepository $productRepository
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(ProductRepository $productRepository, CategoryRepository $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function getList(Request $request): LengthAwarePaginator
    {
        $filter = [];

        if ($request->filled('categoryId')) {
            $filter[] = ['category_id', $request->get('categoryId')];
        }

        if ($request->filled('productName')) {
            $filter[] = ['name', 'LIKE', '%' . $request->get('productName') . '%'];
        }

        return $this->productRepository->productList($filter);
    }

    /**
     * @param int $id
     * @return Collection
     */
    public function productDetail(int $id):Collection
    {
        return $this->productRepository->productDetail($id);
    }

    /**
     * @param int $categoryId
     * @return bool|LengthAwarePaginator|Collection
     */
    public function getProductByCategoryId(int $categoryId): bool|LengthAwarePaginator|Collection
    {
        if ($categoryId)
        {
            $category = $this->categoryRepository->findId($categoryId);
            if (!$category) {
                return false;
            }
            return $this->productRepository->getByCateId($categoryId);
        }

        return $this->productRepository->productList();
    }

}
