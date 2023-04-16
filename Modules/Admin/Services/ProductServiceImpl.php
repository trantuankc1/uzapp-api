<?php

namespace Modules\Admin\Services;

use App\Exceptions\ApiException;
use App\Exports\ProductExport;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Admin\Contracts\Repositories\Mysql\ProductRepository;
use Modules\Admin\Contracts\Services\ProductService;
use Modules\Admin\Http\Requests\Product\ProductRequest;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use function PHPUnit\Framework\throwException;

class ProductServiceImpl implements ProductService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getList(Request $request)
    {
        $filters = [];
        if ($request->filled('product_id')) {
            $filters[] = ['id', $request->input('product_id')];
        }
        if ($request->filled('product_name')) {
            $filters[] = ['name', 'LIKE', '%' . $request->input('product_name') . '%'];
        }

        return $this->productRepository->getAllWithFilter($filters);
    }

    public function findById(int $productId): ?Product
    {
        return $this->productRepository->findById($productId);
    }

    public function changeStatus(Request $request, $id): ?Product
    {
        $product = $this->findById($id);
        if ($product) {
            $product->status = $request->input('status') ? 1 : 0;
            $this->productRepository->save($product);
        }

        return $product;
    }

    public function store(ProductRequest $request)
    {
        $product = new Product();
        $product->code = $request->input('code') ? trim($request->input('code')) : null;
        $product->name = trim($request->input('productName'));
        $product->category_id = trim($request->input('categoryId'));
        $product->price = $request->input('productPrice') ? trim($request->input('productPrice')) : null;
        $product->quantity = $request->input('productPrice') ? trim($request->input('amount')) : 0;
        $product->description = $request->input('description') ? trim($request->input('description')) : null;
        $product->status = 1;
        $product->created_by_id = 1;

        if ($request->imageFile != null) {
            $product->thumbnail = trim($request->input('imageFile'));
        }

        $this->productRepository->save($product);
    }

    public function show(int $productId): ?Product
    {
        return $this->productRepository->findById($productId);
    }

    public function update(ProductRequest $request, int $productId)
    {
        $product = $this->findById($productId);
        $product->code = $request->input('code') ? trim($request->input('code')) : null;
        $product->name = trim($request->input('productName'));
        $product->category_id = trim($request->input('categoryId'));
        $product->price = $request->input('productPrice') ? trim($request->input('productPrice')) : null;
        $product->quantity = $request->input('productPrice') ? trim($request->input('amount')) : 0;
        $product->description = $request->input('description') ? trim($request->input('description')) : null;
        $product->status = 1;
        $product->created_by_id = 1;

        if ($request->imageFile != null) {
            $product->thumbnail = trim($request->input('imageFile'));
        }

        $this->productRepository->save($product);
    }

    public function delete(int $productId): ?Product
    {
        $product = $this->findById($productId);
        if ($product) {
            $product->delete();
        }

        return $product;
    }

    public function exportCSV(Request $request): BinaryFileResponse
    {
        $filters = [];
        if ($request->filled('product_id')) {
            $filters[] = ['id', $request->input('product_id')];
        }
        if ($request->filled('product_name')) {
            $filters[] = ['name', 'LIKE', '%' . $request->input('product_name') . '%'];
        }
        return Excel::download(new ProductExport($filters), 'products.csv');
    }

    public function uploadImage(object $file): string
    {
        $imageName = Carbon::now()->timestamp . '_' . $file->getClientOriginalName();

        /*if (env('APP_ENV') == 'local') {
            return '/storage/' . $file->storeAs('products', $imageName, 'public');
        }*/

        Storage::disk('s3')->put('products/' . $imageName, file_get_contents($file), 'public');

        return Storage::disk('s3')->url('products/' . $imageName);
    }

}
