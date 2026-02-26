<?php

namespace App\Http\Requests\Admin\User;

use App\DTO\Admin\User\UpdateUserDTO;
use App\Enum\UserRoles;
use App\Exceptions\BadRequestException;
use App\Exceptions\ErrorException;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class ChangePasswordRequest extends FormRequest
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
            'current_password' => ['required', 'string'],
            'password'         => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    /** Сообщения ошибок валидации */
    public function messages(): array
    {
        return [
            'password.min'       => 'Пароль должен состоять минимум из 8 символов',
            'password.confirmed' => 'Пароли не совпадают',
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            if (!Hash::check($this->input('current_password'), User::find($this->route('user'))->password)) {
                $validator->errors()->add('current_password', 'Не правильный пароль');
            }
        });
    }

    /**
     * DTO после валидации данных
     *
     * @throws ErrorException
     * @throws BadRequestException
     */
    public function getDto(): UpdateUserDTO
    {
        if ($this->user()->role !== UserRoles::MASTER && $this->user()->role !== UserRoles::USER) {
            throw new BadRequestException(
                message: 'Возникла ошибка',
            );
        }

        $user = User::findOrFail($this->route('user'));

        if (!$this->user()->is($user)) {
            throw new BadRequestException(
                message: 'Возникла ошибка',
            );
        }

        return new UpdateUserDTO(
            user: $user,
            password: $this->input('password'),
            current_password: $this->input('current_password'),
        );
    }
}
