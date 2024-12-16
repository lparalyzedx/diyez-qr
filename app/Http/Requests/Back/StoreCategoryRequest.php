<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'name' => 'required|max:255',
            'image' => 'required|image|mimes:png,jpg,jpeg',
            'categorie_id' => [
                 'nullable',
                function ($attribute, $value, $fail) {
                    if ($value !== null && $value !== '0' && !\DB::table('categories')->where('id', $value)->exists()) {
                        $fail('Kategori bulunamadı.');
                    }
                },
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Kategori adı boş bırakılamaz.',
            'name.max' => 'Kategori adı en fazla 255 karakter olmalıdır.',
            'image.required' => 'Kategori resmi boş bırakılamaz.',
            'image.image' => 'Lütfen geçerli bir resim yükleyiniz.',
            'image.mimes' => 'Resim dosyası yalnızca jpeg, jpg, png formatında olmalıdır.',
            'categorie_id.required' => 'Kategori boş bırakılamaz.',
            'categorie_id.exists' => 'Kategori bulunamadı.'
        ];
    }
}
