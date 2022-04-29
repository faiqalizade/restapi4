<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{

    use ValidationException;

    public function rules()
    {
        return [
            'title' => 'required|string|min:3',
        ];
    }
}
