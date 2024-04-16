<?php

namespace App\Http\Requests\Web\Admin\Track;

use Illuminate\Foundation\Http\FormRequest;

class TrackUpdateRequest extends FormRequest
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
            "name" => "required|string|max:255",
            "track" => "required|file",
            "album_id" => "required|integer"
        ];
    }
}
