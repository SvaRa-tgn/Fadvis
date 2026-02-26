<?php

namespace App\Http\Requests\Admin\Color;

use App\DTO\Admin\Color\CreateColorDTO;
use App\Enum\UserRoles;
use App\Exceptions\BadRequestException;
use App\Exceptions\ErrorException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CreateColorRequest extends FormRequest
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
            'name'    => ['required', 'string', 'unique:colors', 'max:20', 'cyrillic'],
            'article' => ['nullable', 'string', 'unique:colors', 'max:20'],
            'img'     => ['required', 'image', 'max:2048'],
        ];
    }

    /** Сообщения ошибок валидации */
    public function messages(): array
    {
        return [
            'name.cyrillic'    => 'Название должно состоять из русских букв',
            'name.required'    => 'Название должно быть обязательно',
            'name.max'         => 'Название не должно превышать 20 символов',
            'name.unique'      => 'Такое название уже есть',
            'article.required' => 'Индекс цвета должен быть обязательно',
            'article.max'      => 'Индекс цвета не должен превышать 20 символов',
            'article.unique'   => 'Такое индекс уже есть',
            'img.required'     => 'Фотография должна быть обязательно',
            'img.max'          => 'Фотография  слишком большого размера',
        ];
    }

    /**
     * DTO после валидации данных
     *
     * @throws BadRequestException
     */
    public function getDto(): CreateColorDTO
    {
        if ($this->user()->role !== UserRoles::MASTER) {
            throw new BadRequestException(
                message: 'Возникла ошибка',
            );
        }

        return new CreateColorDTO(
            name: $this->input('name'),
            slug: Str::of($this->input('name'))->slug('-'),
            article: $this->input('article'),
            img: $this->file('img'),
        );
    }
}
