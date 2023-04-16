<?php

namespace Modules\Api\Contracts\Services;


use App\Models\Category;
use Illuminate\Http\Request;

interface CategoryService
{
    /**
     * @param Category $category
     * @return mixed
     */
    public function getList(Category $category);

    public function findId(int $id);
}
