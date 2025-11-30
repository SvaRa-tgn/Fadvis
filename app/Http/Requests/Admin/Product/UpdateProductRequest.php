<?php

namespace App\Http\Requests\Admin\Product;

use App\DTO\Admin\Product\UpdateProductDTO;
use App\Enum\ProthesisLevel;
use App\Enum\Status;
use App\Enum\ProthesisSide;
use App\Enum\ProthesisSize;
use App\Enum\ProthesisType;
use App\Enum\UserRoles;
use App\Exceptions\ErrorException;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateProductRequest extends FormRequest
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
            'name'            => ['nullable', 'string', 'unique:products', 'max:255'],
            'article'         => ['nullable', 'string', 'unique:products', 'max:50'],
            'category_id'     => ['nullable', 'int'],
            'status'          => ['nullable', 'string', 'max:20'],
            'type'            => ['nullable', 'string', 'max:20'],
            'description'     => ['nullable', 'string', 'max:500'],
            'size'            => ['nullable', 'string', 'max:20'],
            'side'            => ['nullable', 'string', 'max:15'],
            'level'           => ['nullable', 'string', 'max:15'],
            'volume_size'     => ['nullable', 'string', 'max:30'],
            'length_size'     => ['nullable', 'string', 'max:30'],
            'color_id'        => ['nullable', 'int'],
            'is_select_color' => ['nullable', 'string'],
            'price'           => ['nullable', 'numeric'],
            'made'            => ['nullable', 'string', 'max:15'],
            'manufacturer'    => ['nullable', 'string', 'max:50'],
            'img'             => ['nullable', 'image', 'max:4048'],
            'image'           => ['nullable', 'image', 'max:4048'],
        ];
    }

    /** Сообщения ошибок валидации */
    public function messages(): array
    {
        return [
            'name.max'                 => 'Название не должно превышать 255 символов',
            'name.unique'              => 'Такое название уже есть',
            'article.max'              => 'Артикул не должен превышать 50 символов',
            'article.unique'           => 'Такое артикул уже есть',
            'status.max'               => 'Статус не должен превышать 20 символов',
            'type.max'                 => 'Тип протеза не должен превышать 20 символов',
            'description.max'          => 'Описание не должно превышать 500 символов',
            'size.max'                 => 'Размер не должен превышать 20 символов',
            'side.max'                 => 'Сторона протезирования не должна превышать 20 символов',
            'volume_size.max'          => 'Объем пястья не должен превышать 30 символов',
            'length_size.max'          => 'Длина не должна превышать 30 символов',
            'is_select_color.required' => 'Значение цвета должно быть обязательно',
            'made.max'                 => 'Страна производства не должна превышать 20 символов',
            'manufacturer.max'         => 'Производитель должен не превышать 20 символов',
            'img.max'                  => 'Фотография  слишком большого размера',
            'image.max'                  => 'Фотография  слишком большого размера',
        ];
    }

    /** DTO после валидации данных
     * @throws ErrorException
     */
    public function getDto(): UpdateProductDTO
    {
        if ($this->user()->role !== UserRoles::MASTER->value) {
            throw new ErrorException(
                message: 'Страница не найдена',
            );
        }

        return new UpdateProductDTO(
            product: Product::find($this->route('id')),
            category: Category::find($this->input('category_id')),
            status: Status::tryFrom($this->input('status')),
            type: ProthesisType::tryFrom($this->input('type')),
            size: ProthesisSize::tryFrom($this->input('size')),
            side: ProthesisSide::tryFrom($this->input('size')),
            level: ProthesisLevel::tryFrom($this->input('level')),
            color: Color::find($this->input('color_id')),
            name: $this->input('name'),
            slug: Str::of($this->input('name'))->slug('-'),
            article: $this->input('article'),
            description: $this->input('description'),
            isSelectColor: $this->input('is_select_color') === 'true',
            price: $this->input('price'),
            made: $this->input('made'),
            manufacturer: $this->input('manufacturer'),
            img: $this->file('img'),
            image: $this->file('image'),
            volumeSize: $this->input('volumeSize'),
            lengthSize: $this->input('lengthSize'),
        );
    }
}
