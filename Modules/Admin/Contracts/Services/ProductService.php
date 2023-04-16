<?php

namespace Modules\Admin\Contracts\Services;

use App\Models\Product;
use Illuminate\Http\Request;
use Modules\Admin\Http\Requests\Product\ProductRequest;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

interface ProductService
{
    public function getList(Request $request);

    public function findById(int $productId): ?Product;

    public function changeStatus(Request $request, $id): ?Product;

    public function store(ProductRequest $request);

    public function show(int $productId);

    public function update(ProductRequest $request, int $productId);

    public function delete(int $productId): ?Product;

    public function exportCSV(Request $request): BinaryFileResponse;

    public function uploadImage(Object $file): string;

}
