<?php

namespace App\Http\Requests\Admin\User;

use App\DTO\Admin\User\UpdateUserDTO;
use App\Enum\Status;
use App\Enum\UserRoles;
use App\Exceptions\ErrorException;
use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Правила валидации запроса на обновление пользователя
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'role'         => ['nullable', 'string', 'max:12'],
            'name'         => ['nullable', 'string', 'max:50', 'cyrillic'],
            'surname'      => ['nullable', 'string', 'max:50', 'cyrillic'],
            'patronymic'   => ['nullable', 'string', 'max:50', 'cyrillic'],
            'email'        => ['nullable', Rule::unique('users', 'email')
                ->ignore($this->route('user')), 'email', 'max:50'],
            'phone'        => ['nullable', Rule::unique('users', 'phone')
                ->ignore($this->route('user')), 'string', 'phone'],
            'messenger'    => ['nullable', 'string', 'max:10'],
            'site'         => ['nullable', 'string', 'max:50'],
            'organization' => ['nullable', 'string', 'max:50'],
            'address'      => ['nullable', 'string', 'max:255'],
            'inn'          => ['nullable', 'string', 'min:10', 'max:12'],
            'ogrn'         => ['nullable', 'string', 'min:13', 'max:15'],
            'status'       => ['nullable', 'string', 'max:15'],
        ];
    }

    /** Сообщения ошибок валидации */
    public function messages(): array
    {
        return [
            'name.cyrillic' => 'Имя должно состоять из русских букв',
            'surname.cyrillic' => 'Фамилия должна состоять из русских букв',
            'patronymic.cyrillic' => 'Отчество должно состоять из русских букв',
            'email' => 'Вы ввели не email',
            'email.max' => 'email должен состоять максимум из 50 символов',
            'email.unique' => 'Пользователь с таким email уже существует',
            'phone.phone' => 'Телефон должен состоять из цифр и начинаться на +7',
            'phone.unique' => 'Пользователь с таким телефоном уже существует',
            'site.max' => 'Сайт должен состоять максимум из 50 символов',
            'organization.max' => 'Название организации должно состоять максимум из 50 символов',
            'address.max' => 'Адрес должен состоять максимум из 255 символов',
            'inn.max' => 'ИНН должен состоять максимум из 12 символов',
            'inn.min' => 'ИНН должен состоять минимум из 10 символов',
            'ogrn.max' => 'ОГРН/ОГРНИП должен состоять максимум из 15 символов',
            'ogrn.min' => 'ОГРН/ОГРНИП должен состоять минимум из 13 символов',
        ];
    }

    /** DTO после валидации данных
     * @throws ErrorException
     */
    public function getDto(): UpdateUserDTO
    {
        if ($this->user()->role !== UserRoles::MASTER) {
            throw new ErrorException(
                message: 'Страница не найдена',
            );
        }

        $slug = $this->input('surname') . ' ' . $this->input('name'). ' ' . $this->input('patronymic');

        $count = User::where('slug', $slug)->get()->count();

        if ($count > 0) {
            $slug = $slug . '-' . $count;
        }

        return new UpdateUserDTO(
            user: User::findOrFail($this->route('user')),
            role: UserRoles::tryFrom($this->input('role')),
            status: Status::tryFrom($this->input('status')),
            route: request()->url(),
            name: $this->input('name'),
            surname: $this->input('surname'),
            patronymic: $this->input('patronymic') ?? null,
            slug: $slug,
            email: $this->input('email'),
            phone: $this->input('phone'),
            messenger: $this->input('messenger'),
            organization: $this->input('organization'),
            address: $this->input('address'),
            site: $this->input('site'),
            inn: $this->input('inn'),
            ogrn: $this->input('ogrn'),
        );
    }
}
