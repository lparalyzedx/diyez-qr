<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;

class PhoneUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'phone' => 'required|regex:/05[0,3,4,5,6][0-9]\d\d\d\d\d\d\d$/|unique:users,phone,' . $this->id . ',id',
            'confirmphonepassword' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'phone.required' => 'Telefon Numarası boş bırakılamaz.',
            'phone.regex' => 'Lütfen geçerli bir telefom numarası giriniz.',
            'phone.unique' => 'Telefon Numarası sistemde mevcut.',
            'confirmphonepassword.required' => 'Parola boş bırakılamaz.'
        ];
    }
}
