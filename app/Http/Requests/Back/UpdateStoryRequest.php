<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'update_name' => 'required|max:255',
            'update_slug' => 'required|url|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'update_name.required' => 'İsim boş bırakılamaz.',
            'update_name.max' => 'İsim en fazla 255 karakter olmalıdır.',
            'update_slug.required' => 'Link boş bırakılamaz.',
            'update_slug.max' => 'Link en fazla 255 karakter olmalıdır.',
            'update_slug.url' => 'Link bir URL olmalıdır.',
        ];
    }
}
