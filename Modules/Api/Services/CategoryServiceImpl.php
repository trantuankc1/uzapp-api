<?php

namespace Modules\Api\Services;

use App\Models\Category;
use Illuminate\Http\Request;
use Modules\Api\Contracts\Repositories\Mysql\CategoryRepository;
use Modules\Api\Contracts\Services\CategoryService;

class CategoryServiceImpl implements CategoryService
{
    public CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param Category $category
     * @return mixed
     */
    public function getList(Category $category)
    {
        return $this->categoryRepository->getList($category);
    }

    public function findId(int $id)
    {
        return $this->categoryRepository->findId($id);
    }
}
