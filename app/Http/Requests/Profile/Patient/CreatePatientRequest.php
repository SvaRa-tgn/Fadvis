<?php

namespace App\Http\Requests\Profile\Patient;

use App\DTO\Profile\Patient\CreatePatientDTO;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class CreatePatientRequest extends FormRequest
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
            'name'       => ['required', 'string', 'max:50', 'cyrillic'],
            'surname'    => ['required', 'string', 'max:50', 'cyrillic'],
            'patronymic' => ['nullable', 'string', 'max:50', 'cyrillic'],
            'email'      => ['required', 'string', 'email', 'max:50'],
            'phone'      => ['required', 'string', 'string', 'phone'],
            'first_img'  => ['required', 'image', 'max:4048'],
            'second_img' => ['required', 'image', 'max:4048'],
        ];
    }

    /** Сообщения ошибок валидации */
    public function messages(): array
    {
        return [
            'name.cyrillic'       => 'Имя должно состоять из русских букв',
            'name.required'       => 'Имя должно быть обязательно',
            'surname.required'    => 'Фамилия должна быть обязательно',
            'surname.cyrillic'    => 'Фамилия должна состоять из русских букв',
            'patronymic.cyrillic' => 'Отчество должно состоять из русских букв',
            'email.required'      => 'Вы ввели не email',
            'email.max'           => 'email должен состоять максимум из 50 символов',
            'email.unique'        => 'Пользователь с таким email уже существует',
            'phone.phone'         => 'Телефон должен состоять из цифр и начинаться на +7',
            'phone.unique'        => 'Пользователь с таким телефоном уже существует',
            'first_img'           => 'Размер файла не должен превышать 4мб',
            'second_img'          => 'Размер файла не должен превышать 4мб',
        ];
    }

    public function getDto(): CreatePatientDTO
    {
        return new CreatePatientDTO(
            name: $this->input('name'),
            surname: $this->input('surname'),
            email: $this->input('email'),
            phone: $this->input('phone'),
            patronymic: $this->input('patronymic') ?? null,
            img: [$this->file('first_img'), $this->file('second_img')],
        );
    }
}
