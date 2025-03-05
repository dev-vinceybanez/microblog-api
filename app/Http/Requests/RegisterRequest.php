<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
            "username" => [
                "nullable",
                "string",
                "unique:users,username",
                "min:6",
                "max:8",
                "bail"
            ],
            "first_name" => [
                "required",
                "string",
                "min:2",
                "max:255",
                "bail"
            ],
            "last_name" => [
                "required",
                "string",
                "min:2",
                "max:255",
                "bail"
            ],
            "email" => [
                "required",
                "string",
                "email",
                "unique:users,email",
                "max:255",
                "bail"
            ],
            "password" => [
                "required",
                "string",
                Password::min(8)->letters()->mixedCase()->numbers()->symbols(),
                "max:20",
                "confirmed",
                "bail"
            ],
            "password_confirmation" => [
                "required",
                "string",
                Password::min(8)->letters()->mixedCase()->numbers()->symbols(),
                "max:20",
                "bail"
            ],
            "birthday" => [
                "nullable",
                "date",
                "date_format:Y-m-d",
                "bail"
            ],
            "lot_block_sub" => [
                "nullable",
                "string",
                "max:255",
                "bail"
            ],
            "street" => [
                "nullable",
                "string",
                "max:255",
                "bail"
            ],
            "city" => [
                "nullable",
                "string",
                "max:255",
                "bail"
            ],
            "province" => [
                "nullable",
                "string",
                "max:255",
                "bail"
            ],
            "country" => [
                "nullable",
                "string",
                "max:255",
                "bail"
            ],
            "zip_code" => [
                "nullable",
                "string",
                "max:100",
                "bail"
            ],
            "phone_no" => [
                "nullable",
                "string",
                "max:100",
                "bail"
            ],
        ];
    }
}
