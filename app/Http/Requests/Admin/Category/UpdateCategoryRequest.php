<?php

namespace App\Http\Requests\Admin\Category;

use App\DTO\Admin\Category\UpdateCategoryDTO;
use App\Enum\Status;
use App\Enum\UserRoles;
use App\Exceptions\BadRequestException;
use App\Models\Category;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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
     * Правила валидации запроса на обновление Категории
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'              => ['nullable', 'string', Rule::unique('categories', 'name')
                ->ignore($this->route('category')), 'max:50', 'cyrillic'],
            'second_name'       => ['nullable', 'string', Rule::unique('categories', 'second_name')
                ->ignore($this->route('category')), 'max:100'],
            'description'       => ['nullable', 'string', 'max:3000'],
            'status'            => ['nullable', 'string', 'max:15'],
            'img'               => ['nullable', 'image', 'max:4200'],
        ];
    }

    /** Сообщения ошибок валидации */
    public function messages(): array
    {
        return [
            'name.cyrillic'        => 'Название должно состоять из русских букв',
            'name.max'             => 'Название не должно превышать 50 символов',
            'name.unique'          => 'Такое название уже есть',
            'second_name.max'      => 'Название категории не должно превышать 100 символов',
            'second_name.unique'   => 'Такое название уже есть',
            'description.max'      => 'Описание не должно превышать 1000 символов',
            'status.max'           => 'Описание не должно превышать 15 символов',
            'img.max'              => 'Фотография должна быть не более 4мб',
        ];
    }

    /**
     * DTO после валидации данных
     *
     * @throws BadRequestException
     */
    public function getDto(): UpdateCategoryDTO
    {
        if ($this->user()->role !== UserRoles::MASTER) {
            throw new BadRequestException(
                message: 'Возникла ошибка',
            );
        }

        return new UpdateCategoryDTO(
            category: Category::findOrFail($this->route('category')),
            status: Status::tryFrom($this->input('status')),
            name: $this->input('name'),
            slug: Str::of($this->input('name'))->slug('-'),
            second_name: $this->input('second_name'),
            description: $this->input('description'),
            img: $this->file('img'),
        );
    }
}
