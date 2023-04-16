<?php

namespace Modules\Api\Http\Controllers;

use App\Models\Category;
use Modules\Api\Contracts\Services\CategoryService;
use App\Transformers\SuccessResource;

class CategoryController extends BaseController
{
    /**
     * @var CategoryService
     */
    public CategoryService $categoryService;

    /**
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * @param Category $category
     * @return SuccessResource
     */
    public function getList(Category $category)
    {
        $list = $this->categoryService->getList($category);

        return SuccessResource::make($list);
    }
}
