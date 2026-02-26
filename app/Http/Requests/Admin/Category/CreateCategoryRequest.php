<?php

namespace App\Http\Requests\Admin\Category;

use App\DTO\Admin\Category\CreateCategoryDTO;
use App\Enum\UserRoles;
use App\Exceptions\BadRequestException;
use App\Exceptions\ErrorException;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CreateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Правила валидации запроса на создание Категории
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'        => ['required', 'string', 'unique:categories', 'max:50', 'cyrillic'],
            'second_name' => ['required', 'string', 'unique:categories', 'max:100'],
            'description' => ['required', 'string', 'max:3000'],
            'img'         => ['required', 'image', 'max:4200'],
        ];
    }

    /** Сообщения ошибок валидации */
    public function messages(): array
    {
        return [
            'name.cyrillic'        => 'Название должно состоять из русских букв',
            'name.required'        => 'Название должно быть обязательно',
            'name.max'             => 'Название не должно превышать 50 символов',
            'name.unique'          => 'Такое название уже есть',
            'second_name.required' => 'Название категории должно быть обязательно',
            'second_name.max'      => 'Название категории не должно превышать 100 символов',
            'second_name.unique'   => 'Такое название уже есть',
            'description.required' => 'Описание должно быть обязательно',
            'description.max'      => 'Описание не должно превышать 3000 символов',
            'img.required'         => 'Фотография должна быть обязательно',
            'img.max'              => 'Фотография должна быть не более 4мб',
        ];
    }

    /**
     * DTO после валидации данных
     *
     * @throws BadRequestException
     */
    public function getDto(): CreateCategoryDTO
    {
        if ($this->user()->role !== UserRoles::MASTER) {
            throw new BadRequestException(
                message: 'Возникла ошибка',
            );
        }

        return new CreateCategoryDTO(
            name: $this->input('name'),
            slug: Str::of($this->input('name'))->slug('-'),
            second_name: $this->input('second_name'),
            description: $this->input('description'),
            img: $this->file('img'),
        );
    }
}
