<?php

namespace App\Repositories\Eloquent;

use App\Helpers\DataTable\HasDataTable;
use App\Models\Product;

class ProductRepository extends BaseRepository
{
    use HasDataTable;

    const MODEL_LABEL = 'Product';

    public function __construct(
        Product $model
    ) {
        parent::__construct($model);
    }

    public function create($data)
    {
        $data['user_id'] ??= optional(auth()->user())->id;
        return parent::create($data);
    }

    public function dataTable($data)
    {
        return $this->useDataTable($data);
    }
}
