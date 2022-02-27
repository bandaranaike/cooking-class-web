<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class StoreReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    #[ArrayShape(["rating" => "string", "user_name" => "string", "message" => "string", "user_image" => "string"])] public function rules(): array
    {
        return [
            "rating" => "required|numeric",
            "user_name" => "required|string",
            "message" => "required|string|max:1024",
            "user_image" => "file|mimes:jpg,png,gif"
        ];
    }
}
