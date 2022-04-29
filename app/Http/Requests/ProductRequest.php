<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{

  use ValidationException;

    public function rules()
    {
        return [
            'title' => 'required|min:3',
            'price' => 'required|int',
            'categories' => 'required|array|min:2|max:10|exists:categories,id',
            'categories.*' => 'required|int|distinct'
        ];
    }
}
