<?php

namespace App\Http\Requests\Api\Product;

use App\Http\Requests\Api\BaseFormRequest;

class CreateOrUpdateProductRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sku' => 'required|string',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'style' => 'nullable|string',
            'color' => 'nullable|string',
            'size' => 'nullable|string',
            'price' => 'required|numeric',
        ];
    }
}
