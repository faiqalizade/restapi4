<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFilterRequest extends FormRequest
{
    use ValidationException;

    public function rules()
    {
        return [
            'product_name' => 'min:3|string',
            'category_name' => 'min:3|string',
            'category_id' => 'int|exists:categories,id',
            'price_from' => 'int',
            'price_to' => 'int',
            'not_deleted' => 'int|in:0,1',
        ];
    }
}
