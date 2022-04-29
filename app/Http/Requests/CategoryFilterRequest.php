<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryFilterRequest extends FormRequest
{
    use ValidationException;

    public function rules()
    {
        return [
            'title' => 'min:3|string',
            'not_deleted' => 'int|in:1,2'
        ];
    }
}
