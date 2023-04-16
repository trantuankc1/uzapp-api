<?php

namespace Modules\Admin\Services;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Admin\Contracts\Repositories\Mysql\CategoryRepository;
use Modules\Admin\Contracts\Services\CategoryService;
use Modules\Admin\Http\Requests\Category\CategoryRequest;


class CategoryServiceImpl implements CategoryService
{
    protected CategoryRepository $categoryRepository;

    /**
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param CategoryRequest $request
     * @return Category
     */
    public function save(CategoryRequest $request): Category
    {
        $category = new Category();

        $category->category_name = $request->get('category_name');
        $category->note = $request->get('note');

        return $this->categoryRepository->save($category);
    }

    /**
     * @param int $id
     * @return int
     * @throws \Exception
     */
    public function destroy(int $id): int
    {
        return $this->categoryRepository->destroy($id);
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getAllCategory(Request $request): LengthAwarePaginator
    {
        $filters = [];
        if ($request->filled('category_id')) {
            $filters[] = ['id', $request->input('category_id')];
        }
        if ($request->filled('category_name')) {
            $filters[] = ['category_name', 'LIKE', '%' . $request->input('category_name') . '%'];
        }

        return $this->categoryRepository->getAllCategory($filters);
    }

    /**
     * @return mixed
     */
    public function getAllCategoryEnable()
    {
        return $this->categoryRepository->getAllCategoryEnable();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function edit(int $id)
    {
        return $this->categoryRepository->edit($id);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return mixed
     */
    public function update(Request $request, int $id)
    {
        $category = $this->categoryRepository->edit($id);
        $category->category_name = $request->get('category_name');
        $category->note = $request->get('note');

        return $this->categoryRepository->update($category);
    }


    public function search()
    {

    }

    /**
     * @param Request $request
     * @param $id
     * @return Category|mixed|null
     */
    public function changeStatus(Request $request, $id)
    {
        $category = $this->findId($id);
        if ($category) {
            $category->status = $request->input('status') ? 1 : 0;
            $this->categoryRepository->save($category);
        }

        return $category;
    }

    /**
     * @param int $categoryId
     * @return Category|null
     */
    public function findId(int $categoryId): ?Category
    {
        return $this->categoryRepository->findId($categoryId);
    }

    public function getCountAllProductByCategoryId(int $categoryId): int
    {
        $category = $this->categoryRepository->findId($categoryId);
        return $category->products()->count();
    }
}
