<?php

namespace Modules\Api\Contracts\Repositories\Mysql;


use App\Models\Category;

interface CategoryRepository
{
    /**
     * @param Category $category
     * @return mixed
     */
    public function getList(Category $category);

    /**
     * @param int $id
     * @return mixed
     */
    public function findId(int $categoryId);
}
