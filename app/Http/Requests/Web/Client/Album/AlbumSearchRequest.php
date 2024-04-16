<?php

namespace App\Http\Requests\Web\Client\Album;

use Illuminate\Foundation\Http\FormRequest;

class AlbumSearchRequest extends FormRequest
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
            "search" => "required|string|max:255"
        ];
    }
}
