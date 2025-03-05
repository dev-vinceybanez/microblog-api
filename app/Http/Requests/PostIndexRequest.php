<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostIndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "page" => [
                "bail",
                "required",
                "integer",
                "min:1"
            ],
            "per_page" => [
                "bail",
                "required",
                "integer",
                "min:1"
            ],
            "search" => [
                "bail",
                "nullable",
                "string",
                "max:255",
            ]
        ];
    }
}
