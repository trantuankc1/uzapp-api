<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Product;
use Illuminate\Validation\ValidationException;
use App\Transformers\ErrorResource;
use App\Transformers\SuccessResource;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Admin\Contracts\Services\CategoryService;
use Modules\Admin\Contracts\Services\ProductService;
use Modules\Admin\Http\Requests\Product\ProductRequest;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ProductController extends Controller
{
    private ProductService $productService;
    private CategoryService $categoryService;

    public function __construct(ProductService $productService, CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    /**
     * @return View
     */
    public function index(Request $request): View
    {
        $items = $this->productService->getList($request);

        return view('admin::pages.product.index', compact('items'));
    }

    public function changeStatus(Request $request, $id)
    {
        $item = $this->productService->changeStatus($request, $id);
        if (!$item) {
            return new ErrorResource(404);
        }

        return new SuccessResource();
    }

    public function create()
    {
        $categories = $this->categoryService->getAllCategoryEnable();
        return view('admin::pages.product.create', compact('categories'));
    }

    /**
     * @throws ValidationException
     */
    public function store(ProductRequest $request)
    {
        if ($request->code) {
            $this->checkCode($request->code);
        }
        $this->productService->store($request);

        return redirect()->route('admin::product.index')->with('notify', trans('admin::messages.product.create_success'));
    }

    public function show($id): JsonResponse
    {
        $item = $this->productService->show($id);
        return response()->json($item);
    }

    public function edit($id)
    {
        $categories = $this->categoryService->getAllCategoryEnable();
        $item = $this->productService->findById($id);
        if (!$item) {
            return abort(404);
        }
        return view('admin::pages.product.edit', compact('item', 'categories'));
    }

    /**
     * @throws ValidationException
     */
    public function update(ProductRequest $request, $id): RedirectResponse
    {
        if ($request->code) {
            $this->checkCode($request->code, $id);
        }
        $this->productService->update($request, $id);
        return redirect()->route('admin::product.index')->with('notify', trans('admin::messages.product.update_success'));
    }

    public function delete($id)
    {
        $item = $this->productService->delete($id);
        if (!$item) {
            return abort(404);
        }

        return redirect()->route('admin::product.index')->with('notify', trans('admin::messages.product.delete_success'));
    }

    /**
     * @throws ValidationException
     */
    public function checkCode(?string $code, int $ignore = null)
    {
        $checkCode = Product::query()->where('code', $code);
        if ($ignore) {
            $checkCode->where('id', '<>', $ignore);
        }
        $checkCode = $checkCode->first();

        if ($checkCode) {
            throw ValidationException::withMessages([
                'code' => trans('admin::messages.product.error_has_existing'),
            ]);
        }
    }

    public function exportCSV(Request $request): BinaryFileResponse
    {
        return $this->productService->exportCSV($request);
    }

    public function uploadImg(Request $request): SuccessResource
    {
        $request->validate(
            [
                'image' => 'required|mimes:jpg,jpeg,png,JPEG,PNG,JPG|max:2000',
            ],
            /*[
                'image.uploaded' => 'Upload the image below 2MB.',
            ]*/
        );
        $path = $this->productService->uploadImage($request->file('image'));
        return new SuccessResource([
            'path' => $path
        ]);
    }
}
