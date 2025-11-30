<?php

namespace App\Http\Requests\Admin\Image;

use App\DTO\Admin\Image\AddImageDTO;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class AddImageRequest extends FormRequest
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
            'images' => ['required', 'array'],
        ];
    }

    public function messages(): array
    {
        return [
            'images.required' => 'Вы не выбрали фотографии',
        ];
    }

    /** DTO после валидации данных */
    public function getDto(): AddImageDTO
    {
        return new AddImageDTO(
            product: Product::find($this->route('product')),
            images: $this->file('images'),
        );
    }
}
