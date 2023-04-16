<?php

namespace Modules\Admin\Http\Controllers;

use App\Transformers\ErrorResource;
use App\Transformers\SuccessResource;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Modules\Admin\Contracts\Services\CategoryService;
use Modules\Admin\Http\Requests\Category\CategoryRequest;

class CategoryController extends Controller
{
    protected CategoryService $categoryService;

    /**
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * @return View
     */

    public function index(Request $request): View
    {
        $categories = $this->categoryService->getAllCategory($request);

        return view('admin::pages.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return View
     */
    public function create(): View
    {
        return view('admin::pages.category.add');
    }

    /**
     * @param CategoryRequest $request
     * @return RedirectResponse
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        $this->categoryService->save($request);

        return redirect()->route('category')->with('notify', trans('admin::messages.category.create_success'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $checkChildren = $this->categoryService->getCountAllProductByCategoryId($id);
        if ($checkChildren) {
            return redirect()->route('category')->with('notify-error', trans('admin::messages.category.error_has_existing'));
        }
        $this->categoryService->destroy($id);

        return redirect()->route('category')->with('notify', trans('admin::messages.category.delete_success'));
    }

    /**
     * @param int $id
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function edit(int $id): \Illuminate\Contracts\View\View|Factory|Application
    {
        $category = $this->categoryService->edit($id);

        return view('admin::pages.category.edit', compact('category'));
    }

    /**
     * @param CategoryRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(CategoryRequest $request, int $id): RedirectResponse
    {
        $this->categoryService->update($request, $id);

        return redirect()->route('category')->with('notify', trans('admin::messages.category.update_success'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return ErrorResource|SuccessResource
     */
    public function changeStatus(Request $request, $id): ErrorResource|SuccessResource
    {
        $item = $this->categoryService->changeStatus($request, $id);

        if (!$item) {
            return new ErrorResource(404);
        }

        return new SuccessResource();
    }


}
