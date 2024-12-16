<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'update_image' => 'nullable|image|mimes:png,jpg,jpeg',
            'update_categorie_id' => [
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
            'update_name.required' => 'Kategori adı boş bırakılamaz.',
            'update_name.max' => 'Kategori adı en fazla 255 karakter olmalıdır.',
            'update_image.required' => 'Kategori resmi boş bırakılamaz.',
            'update_image.image' => 'Lütfen geçerli bir resim yükleyiniz.',
            'update_image.mimes' => 'Resim dosyası yalnızca jpeg, jpg, png formatında olmalıdır.',
            'update_categorie_id.required' => 'Kategori boş bırakılamaz.',
            'update_categorie_id.exists' => 'Kategori bulunamadı.'
        ];
    }
}
