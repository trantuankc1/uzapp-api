<?php

namespace Modules\Admin\Contracts\Repositories\Mysql;

use App\Models\Category;
use http\Env\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CategoryRepository
{
    public function save(Category $category): Category;

    public function find(int $id): Category;

    /**
     * @param int $id
     * @return int
     */
    public function destroy(int $id): int;

    /**
     * @return LengthAwarePaginator
     */
    public function getAllCategory(array $filters, LengthAwarePaginator $paginator): LengthAwarePaginator;


    public function getAllCategoryEnable();

    /**
     * @param int $id
     * @return mixed
     */
    public function edit(int $id);

    /**
     * @param Category $category
     * @return mixed
     */
    public function update(Category $category);

    /**
     * @return mixed
     */
    public function search();

    public function findId(int $categoryId): ?Category;

}
