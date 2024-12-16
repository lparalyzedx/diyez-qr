<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;

class EmailUpdateRequest extends FormRequest
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
            'email' => 'required|max:255|unique:users,email,' . $this->id . ',id',
            'confirmemailpassword' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'E-posta adresi boş bırakılamaz.',
            'email.max' => 'E-posta adresi en fazla 255 karakter olmalıdır.',
            'email.unique' => 'E-posta adresi sistemde mevcut.',
            'password.required' => 'Parola boş bırakılamaz.'
        ];
    }
}
