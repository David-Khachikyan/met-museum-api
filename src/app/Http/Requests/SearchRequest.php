<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'perPage' => ['int'],
            'page' => ['int'],
            'q' => ['required', 'string'],
            'departmentId' => ['int'],
        ];
    }
}
