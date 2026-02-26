<?php

namespace App\Http\Requests\Admin\Product;

use App\DTO\Admin\Product\CreateProductDTO;
use App\Enum\ProthesisGrip;
use App\Enum\ProthesisLevel;
use App\Enum\ProthesisSystem;
use App\Enum\Status;
use App\Enum\ProthesisSide;
use App\Enum\ProthesisSize;
use App\Enum\ProthesisType;
use App\Enum\UserRoles;
use App\Exceptions\BadRequestException;
use App\Exceptions\ErrorException;
use App\Models\Category;
use App\Models\Color;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CreateProductRequest extends FormRequest
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
            'name'            => ['required', 'string', 'unique:products', 'max:255'],
            'article'         => ['required', 'string', 'unique:products', 'max:50'],
            'category_id'     => ['required', 'int'],
            'type'            => ['required', 'string', 'max:20'],
            'description'     => ['required', 'string', 'max:500'],
            'size'            => ['required', 'string', 'max:20'],
            'side'            => ['required', 'string', 'max:15'],
            'level'           => ['required', 'string', 'max:15'],
            'grip'            => ['nullable', 'string', 'max:15'],
            'system'          => ['required', 'string', 'max:15'],
            'volume_size'     => ['nullable', 'string', 'max:30'],
            'length_size'     => ['nullable', 'string', 'max:30'],
            'color_id'        => ['required', 'int'],
            'is_select_color' => ['required', 'string'],
            'price'           => ['required', 'int'],
            'made'            => ['required', 'string', 'max:15'],
            'manufacturer'    => ['required', 'string', 'max:50'],
            'img'             => ['required', 'image', 'max:4048'],
            'imgs'            => ['nullable', 'array'],
        ];
    }

    /** Сообщения ошибок валидации */
    public function messages(): array
    {
        return [
            'name.required'            => 'Название должно быть обязательно',
            'name.max'                 => 'Название не должно превышать 255 символов',
            'name.unique'              => 'Такое название уже есть',
            'article.required'         => 'Артикул должен быть обязательно',
            'article.max'              => 'Артикул не должен превышать 50 символов',
            'article.unique'           => 'Такое артикул уже есть',
            'category_id.required'     => 'Категория должна быть обязательно',
            'status.max'               => 'Статус не должен превышать 20 символов',
            'type.required'            => 'Тип протеза должен быть обязательно',
            'type.max'                 => 'Тип протеза не должен превышать 20 символов',
            'description.required'     => 'Описание должно быть обязательно',
            'description_page.max'     => 'Описание не должно превышать 500 символов',
            'size.required'            => 'Размер должен быть обязательно',
            'size.max'                 => 'Размер не должен превышать 20 символов',
            'side.required'            => 'Сторона протезирования должна быть обязательно',
            'side.max'                 => 'Сторона протезирования не должна превышать 20 символов',
            'level.required'           => 'Узел протеза должен быть обязательно',
            'system.required'          => 'Система протеза должна быть обязательно',
            'volume_size.max'          => 'Объем пястья не должен превышать 30 символов',
            'length_size.max'          => 'Длина не должна превышать 30 символов',
            'color_id.required'        => 'Цвет должен быть обязательно',
            'is_select_color.required' => 'Значение цвета должно быть обязательно',
            'price.required'           => 'Цена должна быть обязательно',
            'made.required'            => 'Страна производства должна быть обязательно',
            'made.max'                 => 'Страна производства не должна превышать 20 символов',
            'manufacturer.required'    => 'Производитель должен быть обязательно',
            'manufacturer.max'         => 'Производитель должен не превышать 20 символов',
            'img.required'             => 'Фотография должна быть обязательно',
            'img.max'                  => 'Фотография  слишком большого размера',
        ];
    }

    /**
     * DTO после валидации данных
     *
     * @throws BadRequestException
     */
    public function getDto(): CreateProductDTO
    {
        if ($this->user()->role !== UserRoles::MASTER) {
            throw new BadRequestException(
                message: 'Возникла ошибка',
            );
        }

        return new CreateProductDTO(
            category: Category::find($this->input('category_id')),
            status: Status::ACTIVE,
            type: ProthesisType::tryFrom($this->input('type')),
            size: ProthesisSize::tryFrom($this->input('size')),
            side: ProthesisSide::tryFrom($this->input('side')),
            level: ProthesisLevel::tryFrom($this->input('level')),
            system: ProthesisSystem::tryFrom($this->input('system')),
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
            grip: ProthesisGrip::tryFrom($this->input('grip')),
            volumeSize: $this->input('volumeSize'),
            lengthSize: $this->input('lengthSize'),
            images: $this->file('imgs'),
        );
    }
}
