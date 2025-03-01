<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCreateRequest extends FormRequest
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
            "body" => [
                "bail",
                "required_without:image",
                "string",
                "max:255",
            ],
            "image" => [
                "bail",
                "required_without:body",
                "image",
                "mimes:jpg,png,gif",
                "max:2048", // 2MB
            ],
        ];
    }
}
