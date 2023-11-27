<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexCompanyRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'page'    => ['filled', 'integer'],
            'search'  => ['filled', 'string', 'min:3'],
            'name'    => ['filled', 'string', 'min:3'],
            'address' => ['filled', 'string', 'min:3'],
        ];
    }
}
