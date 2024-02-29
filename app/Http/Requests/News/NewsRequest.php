<?php

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
            "image" => [
                "nullable",
                "image",
                "mimes:png,jpg,jpeg,svg,webp",
                "max:800"
            ],
            "title" => [
                "required",
                "string",
                "max:255"
            ],
            "categoryId" => [
                "required",
                "exists:categories,id"
            ],
            "publishedAt" =>  $this->id ? [
                "nullable",
                "before_or_equal:".convertDateToFarsi(now()->format("Y-m-d"))
            ] : [
                "required",
                "before_or_equal:".convertDateToFarsi(now()->format("Y-m-d"))
            ],
            "publishedAtH" => [
                "required",
                "date_format:Y-m-d",
                "before_or_equal:".convertDateToFarsi(now()->format("Y-m-d"))
            ],
            "summary" => [
                "required",
                "string",
                "max:255"
            ],
            "description" => [
                "required",
                "string"
            ],
        ];
    }
}
