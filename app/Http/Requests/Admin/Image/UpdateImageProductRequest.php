<?php

namespace App\Http\Requests\Admin\Image;

use App\DTO\Admin\Image\AddImageDTO;
use App\DTO\Admin\Image\UpdateImageProductDTO;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class UpdateImageProductRequest extends FormRequest
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
            'image_product' => ['required', 'image', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'image_product.required' => 'Вы не выбрали фотографию',
        ];
    }

    /** DTO после валидации данных */
    public function getDto(): UpdateImageProductDTO
    {
        return new UpdateImageProductDTO(
            product: Product::find($this->route('product')),
            image: Image::find($this->route('image')),
            image_product: $this->file('image_product'),
        );
    }
}
