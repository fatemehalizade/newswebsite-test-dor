<?php

namespace App\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CommentRequest extends FormRequest
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
            "fullname" => [
                Auth::check() ? "nullable" : "required",
                "string",
                "persian_alpha"
            ],
            "email" => [
                Auth::check() ? "nullable" : "required",
                "string",
                "email"
            ],
            "parentId" => [
              "nullable",
              "numeric",
                $this->parentId != 0 ? "exists:comments,id" : null
            ],
            "comment" => [
                "required",
                "string"
            ],
            "newsId" => [
                "required",
                "exists:news,id"
            ]
        ];
    }
}
