<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;

class PasswordUpdateRequest extends FormRequest
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
            'currentpassword' => 'required',
            'password' => 'required|min:8|max:255|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'currentpassword.required' => 'Güncel parola boş bırakılamaz.',
            'password.required' => 'Yeni parola boş bırakılamaz.',
            'password.min' => 'Parola en az 8 karakter olmalıdır.',
            'password.max' => 'Parola en fazla 255 karakter olmalıdır.',
            'password.confirmed' => 'Parolalar eşleşmiyor.'
        ];
    }
}
