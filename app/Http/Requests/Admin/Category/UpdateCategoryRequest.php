<?php

namespace App\Http\Requests\Admin\Category;

use App\DTO\Admin\Category\CreateCategoryDTO;
use App\DTO\Admin\Category\UpdateCategoryDTO;
use App\Enum\Status;
use App\Enum\UserRoles;
use App\Exceptions\ErrorException;
use App\Models\Category;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

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
            'name'              => ['nullable', 'string', 'unique:categories', 'max:50', 'cyrillic'],
            'second_name'       => ['nullable', 'string', 'unique:categories', 'max:100', 'cyrillic'],
            'description_index' => ['nullable', 'string', 'max:500'],
            'description_page'  => ['nullable', 'string', 'max:2000'],
            'status'            => ['nullable', 'string', 'max:15'],
            'img'               => ['nullable', 'image', 'max:2048'],
        ];
    }

    /** Сообщения ошибок валидации */
    public function messages(): array
    {
        return [
            'name.cyrillic'              => 'Название должно состоять из русских букв',
            'name.max'                   => 'Название не должно превышать 50 символов',
            'name.unique'                => 'Такое название уже есть',
            'second_name.cyrillic'       => 'Название категории должно состоять из русских букв',
            'second_name.max'            => 'Название категории не должно превышать 100 символов',
            'second_name.unique'         => 'Такое название уже есть',
            'description_index.max'      => 'Описание не должно превышать 2000 символов',
            'description_page.max'       => 'Описание не должно превышать 500 символов',
            'status.max'                 => 'Описание не должно превышать 15 символов',
            'img.max'                    => 'Фотография  слишком большого размера',
        ];
    }

    /** DTO после валидации данных
     * @throws ErrorException
     */
    public function getDto(): UpdateCategoryDTO
    {
        if ($this->user()->role !== UserRoles::MASTER->value) {
            throw new ErrorException(
                message: 'Страница не найдена',
            );
        }

        return new UpdateCategoryDTO(
            category: Category::find($this->route('id')),
            status: Status::tryFrom($this->input('status')),
            name: $this->input('name'),
            slug: Str::of($this->input('name'))->slug('-'),
            second_name: $this->input('second_name'),
            description_index: $this->input('description_index'),
            description_page: $this->input('description_page'),
            img: $this->file('img'),
        );
    }
}
