<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;

class UpdateThemeSettingRequest extends FormRequest
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
            'header_color' => 'nullable|max:255',
            'body_color' => 'nullable|max:255',
            'text_color' => 'nullable|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'header_color.max' => 'Header rengi en fazla 255 karakter olmalıdır.',
            'body_color.max' => 'Body rengi en fazla 255 karakter olmalıdır.',
            'text_color.max' => 'Yazı rengi en fazla 255 karakter olmalıdır.'
        ];
    }
}
