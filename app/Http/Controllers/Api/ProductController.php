<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Http\HttpStatuses;
use App\Http\Requests\Api\Product\CreateOrUpdateProductRequest;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends BaseApiController
{
    protected ProductService $productService;

    public function __construct(
        ProductService $productService
    ) {
        $this->productService = $productService;
    }

    public function create(CreateOrUpdateProductRequest $request)
    {
        $product = $this->productService->create($request->validated());
        return $this->respond($product, HttpStatuses::HTTP_OK, "Product successfully added!.");
    }

    public function find($id)
    {
        $product = $this->productService->find($id);
        return $this->respond($product);
    }

    public function update($id, CreateOrUpdateProductRequest $request)
    {
        $product = $this->productService->update($id, $request->validated());
        return $this->respond($product, HttpStatuses::HTTP_OK, "Product successfully updated!.");
    }

    public function delete($id)
    {
        $product = $this->productService->delete($id);
        return $this->respond($product, HttpStatuses::HTTP_OK, "Product successfully deleted!.");
    }

    public function dataTable(Request $request)
    {
        $data = $this->productService->dataTable($request->all());
        return $this->respond($data);
    }
}
