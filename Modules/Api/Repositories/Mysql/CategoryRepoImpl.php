<?php

namespace Modules\Api\Repositories\Mysql;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Api\Constants\CategoryStatus;
use Modules\Api\Contracts\Repositories\Mysql\CategoryRepository;

class CategoryRepoImpl implements CategoryRepository
{

    /**
     * @param Category $category
     * @return Collection
     */
    public function getList(Category $category)
    {
        return Category::query()->where('status', 1)->get();
    }


    public function findId(int $categoryId)
    {
       return  Category::query()
           ->where([
               ['id', $categoryId],
               ['status', 1]
           ])->first();
    }
}
