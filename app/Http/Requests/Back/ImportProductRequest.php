<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;

class ImportProductRequest extends FormRequest
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
            'xlsx' => 'required|file|mimes:xlsx'
        ];
    }

    public function messages(): array
    {
        return [
            'xlsx.required' => 'Dosya boş bırakılamaz.',
            'xlsx.file' => 'Lütfen geçerli bir dosya yükleyiniz.',
            'xlsx.mimes' => 'Lütfen geçerli bir dosya yükleyiniz.'
        ];
    }
}
