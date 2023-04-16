<?php

namespace Modules\Api\Http\Controllers;

use App\Models\Product;
use App\Transformers\ErrorResource;
use App\Transformers\SuccessResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Api\Contracts\Services\CategoryService;
use Modules\Api\Contracts\Services\ProductService;

class ProductController extends BaseController
{
    /**
     * @var ProductService
     */
    public ProductService $productService;

    public CategoryService $categoryService;

    /**
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService,
                                CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    /**
     * @param Request $request
     * @return SuccessResource
     */
    public function productList(Request $request): SuccessResource
    {
        $items = $this->productService->getList($request);

        return SuccessResource::make($items);
    }

    /**
     * @param $id
     * @return SuccessResource
     */
    public function productDetail($id): SuccessResource
    {
        $productDetail = $this->productService->productDetail($id);

        return SuccessResource::make($productDetail);
    }
}
