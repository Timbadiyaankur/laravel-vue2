<?php

namespace App\Services;

use App\Repositories\Eloquent\ProductRepository;
use Illuminate\Validation\ValidationException;

class ProductService
{

    protected ProductRepository $productRepo;

    public function __construct(
        ProductRepository $productRepo
    ) {
        $this->productRepo = $productRepo;
    }

    public function create($data)
    {
        $product = $this->productRepo->findOne([['sku', $data['sku']]]);
        if ($product) throw ValidationException::withMessages(['sku' => sprintf("SKU: \"%s\" already exist!.", $data['sku'])]);
        return $this->productRepo->create($data);
    }

    public function find($id)
    {
        return $this->productRepo->findOrFail($id);
    }

    public function update($id, $data)
    {
        return $this->productRepo->update([['id', $id]], $data);
    }

    public function delete($id)
    {
        $product = $this->productRepo->findOrFail($id);
        $this->productRepo->delete($id);
        return $product;
    }

    public function dataTable($data)
    {
        return $this->productRepo->dataTable($data);
    }
}
