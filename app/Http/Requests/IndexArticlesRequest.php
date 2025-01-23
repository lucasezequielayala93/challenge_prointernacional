<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexArticlesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'categories' => 'sometimes|array',
            'categories.*' => 'string|exists:categories,name',
            'name' => 'sometimes|string|min:3',
        ];
    }

    public function messages(): array
    {
        return [
            'categories.*.exists' => 'The selected category is invalid.',
        ];
    }
}
