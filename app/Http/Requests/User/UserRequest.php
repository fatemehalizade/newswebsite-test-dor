<?php

namespace App\Http\Requests\User;

use App\Enums\GenderTypes;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            "firstName" => [
                "required",
                "string",
                "persian_alpha"
            ],
            "lastName" => [
                "required",
                "string",
                "persian_alpha"
            ],
            "nationalCode" => [
                "required",
                "ir_national_code"
            ],
            "gender" => [
                "required",
                Rule::in(GenderTypes::All)
            ],
            "mobile" => [
                "required",
                "ir_mobile"
            ],
            "email" => [
                "required",
                "email",
                "unique:users,email,".$this->id
            ],
            "image" => [
                "nullable",
                "image",
                "mimes:png,jpg,jpeg,svg,webp",
                "max:800"
            ],
            "username" => [
                "required",
                "string",
                "max:30",
                "unique:users,username,".$this->id,
                "alpha_num"
            ],
            "password" => $this->id ? [
                "nullable",
                "string",
                "max:30",
                "confirmed"
            ] : [
                "required",
                "string",
                "max:30",
                "confirmed"
            ],
            "provinceId" => [
                "nullable",
//                "exists:provinces,id"
            ],
            "cityId" => [
                "nullable",
//                "exists:cities,id"
            ],
            "dutySystemStatus" => [
                $this->gender == GenderTypes::male ? "required" : "nullable"
            ],
            "captcha" => Auth::check() ? "nullable" : [
                "required",
                "captcha"
            ]
        ];
    }
}
