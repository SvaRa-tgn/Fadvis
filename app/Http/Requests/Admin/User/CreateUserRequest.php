<?php

namespace App\Http\Requests\Admin\User;

use App\DTO\Admin\User\CreateUserDTO;
use App\Enum\UserRoles;
use App\Exceptions\ErrorException;
use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CreateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Правила валидации запроса на создание пользователя
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'role'         => ['required', 'string', 'max:12'],
            'name'         => ['required', 'string', 'max:50', 'cyrillic'],
            'surname'      => ['required', 'string', 'max:50', 'cyrillic'],
            'patronymic'   => ['required', 'string', 'max:50', 'cyrillic'],
            'email'        => ['required', 'unique:users', 'email', 'max:50'],
            'phone'        => ['required', 'unique:users', 'string', 'phone'],
            'messenger'    => ['required', 'string', 'max:10'],
            'site'         => ['required', 'string', 'max:50'],
            'organization' => ['required', 'string', 'max:50'],
            'address'      => ['required', 'string', 'max:255'],
            'inn'          => ['required', 'string', 'min:10', 'max:12'],
            'ogrn'         => ['required', 'string', 'min:13', 'max:15'],
            'password'     => ['nullable', 'string', 'min:8', 'confirmed'],
        ];
    }

    /** Сообщения ошибок валидации */
    public function messages(): array
    {
        return [
            'role.required'       => 'Должна быть указан роль',
            'name.cyrillic'       => 'Имя должно состоять из русских букв',
            'name.required'       => 'Имя должно быть обязательно',
            'surname.required'    => 'Фамилия должна быть обязательно',
            'surname.cyrillic'    => 'Фамилия должна быть обязательно',
            'patronymic.cyrillic' => 'Отчество должно состоять из русских букв',
            'email'               => 'Вы ввели не email',
            'email.max'           => 'email должен состоять максимум из 50 символов',
            'email.unique'        => 'Пользователь с таким email уже существует',
            'phone.phone'         => 'Телефон должен состоять из цифр и начинаться на +7',
            'phone.unique'        => 'Пользователь с таким телефоном уже существует',
            'site.max'            => 'Сайт должен состоять максимум из 50 символов',
            'organization.max'    => 'Название организации должно состоять максимум из 50 символов',
            'address.max'         => 'Адрес должен состоять максимум из 255 символов',
            'inn.max'             => 'ИНН должен состоять максимум из 12 символов',
            'inn.min'             => 'ИНН должен состоять минимум из 10 символов',
            'ogrn.max'            => 'ОГРН/ОГРНИП должен состоять максимум из 15 символов',
            'ogrn.min'            => 'ОГРН/ОГРНИП должен состоять минимум из 13 символов',
            'password.min'        => 'Пароль должен состоять минимум из 8 символов',
            'password.confirmed'  => 'Пароли не совпадают',
        ];
    }

    /** DTO после валидации данных
     * @throws ErrorException
     */
    public function getDto(): CreateUserDTO
    {


        $slug = $this->input('surname') . ' ' . $this->input('name'). ' ' . $this->input('patronymic');

        $count = User::where('slug', $slug)->get()->count();

        if ($count > 0) {
            $slug = $slug . '-' . $count;
        }

        return new CreateUserDTO(
            role: UserRoles::tryFrom($this->input('role')),
            name: $this->input('name'),
            surname: $this->input('surname'),
            slug: Str::of($slug)->slug('-'),
            email: $this->input('email'),
            phone: $this->input('phone'),
            messenger: $this->input('messenger'),
            organization: $this->input('organization'),
            address: $this->input('address'),
            password: $this->input('password') ?? Str::password(length: 12),
            patronymic: $this->input('patronymic') ?? null,
            site: $this->input('site'),
            inn: $this->input('inn'),
            ogrn: $this->input('ogrn'),
        );
    }
}
