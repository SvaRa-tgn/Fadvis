<?php

namespace App\Http\Requests\Admin\Color;

use App\DTO\Admin\Color\UpdateColorDTO;
use App\Enum\Status;
use App\Enum\UserRoles;
use App\Exceptions\ErrorException;
use App\Http\Requests\ApiRequest;
use App\Models\Color;

class UpdateColorRequest extends ApiRequest
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
            'name'    => ['nullable', 'string', 'unique:colors', 'max:20', 'cyrillic'],
            'article' => ['nullable', 'string', 'unique:colors', 'max:20'],
            'status'  => ['nullable', 'string', 'max:20'],
            'img'     => ['nullable', 'image', 'max:4048'],
        ];
    }

    /** Сообщения ошибок валидации */
    public function messages(): array
    {
        return [
            'name.cyrillic'  => 'Название должно состоять из русских букв',
            'name.max'       => 'Название не должно превышать 20 символов',
            'name.unique'    => 'Такое название уже есть',
            'article.max'    => 'Индекс цвета не должен превышать 20 символов',
            'article.unique' => 'Такое индекс уже есть',
            'img.max'        => 'Фотография  слишком большого размера',
        ];
    }

    /** DTO после валидации данных
     *
     * @throws ErrorException
     */
    public function getDto(): UpdateColorDTO
    {
        if ($this->user()->role !== UserRoles::MASTER->value) {
            throw new ErrorException(
                message: 'Страница не найдена',
            );
        }

        return new UpdateColorDTO(
            color: Color::find($this->route('id')),
            status: Status::tryFrom($this->input('status')),
            name: $this->input('name'),
            article: $this->input('article'),
            img: $this->file('img'),
        );
    }
}
