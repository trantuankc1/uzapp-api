<?php

namespace Modules\Admin\Repositories\Mysql;

use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Modules\Admin\Contracts\Repositories\Mysql\CategoryRepository;

class CategoryRepoImpl implements CategoryRepository
{

    public function save(Category $category): Category
    {
        $category->save();

        return $category;
    }

    public function find(int $id): Category
    {
        return Category::find($id);
    }

    /**
     * @param int $id
     * @return int
     */
    public function destroy(int $id): int
    {
        return Category::destroy($id);
    }

    /**
     * @param array $filters
     * @param int $paginator
     * @return LengthAwarePaginator
     */
    public function getAllCategory(array $filters, $paginator = 16): LengthAwarePaginator
    {
        return Category::query()
            ->where($filters)
            ->orderByDesc('id')
            ->paginate($paginator);
    }

    /**
     * @return Builder[]|Collection
     */
    public function getAllCategoryEnable(): Collection|array
    {
        return Category::query()->where('status', Category::CATEGORY_ENABLE)->orderBy('id', 'DESC')->get();
    }
    /**
     * @param int $id
     * @return mixed
     */
    public function edit(int $id)
    {
        return Category::findOrFail($id);
    }

    /**
     * @param Category $category
     * @return Category
     */
    public function update(Category $category): Category
    {
        $category->update();

        return $category;
    }


    public function search()
    {
        // TODO: Implement search() method.
    }

    /** @noinspection PhpIncompatibleReturnTypeInspection */
    public function findId(int $categoryId): ?Category
    {
        return Category::query()->findOrFail($categoryId);
    }
}
