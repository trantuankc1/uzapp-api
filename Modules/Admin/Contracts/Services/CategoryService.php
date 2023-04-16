<?php

namespace Modules\Admin\Contracts\Services;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Admin\Http\Requests\Category\CategoryRequest;

interface CategoryService
{
    /**
     * @param CategoryRequest $request
     * @return Category
     */
    public function save(CategoryRequest $request): Category;

    /**
     * @param int $id
     * @return int
     */
    public function destroy(int $id): int;

    /**
     * @return LengthAwarePaginator
     */
    public function getAllCategory(Request $request): LengthAwarePaginator;

    public function getAllCategoryEnable();

    /**
     * @param int $id
     * @return mixed
     */
    public function edit(int $id);

    /**
     * @param Request $request
     * @param int $id
     * @return mixed
     */
    public function update(Request $request, int $id);

    /**
     * @return mixed
     */
    public function search();

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function changeStatus(Request $request, $id);

    /**
     * @param int $categoryId
     * @return mixed
     */
    public function findId(int $categoryId);

    public function getCountAllProductByCategoryId(int $categoryId): int;
}
