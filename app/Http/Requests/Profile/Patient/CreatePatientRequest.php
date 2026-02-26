<?php

namespace App\Http\Requests\Profile\Patient;

use App\DTO\Profile\Patient\CreatePatientDTO;
use App\Enum\GenderType;
use App\Enum\MessengerType;
use App\Enum\ProthesisLevel;
use App\Enum\ProthesisType;
use App\Enum\UserRoles;
use App\Exceptions\BadRequestException;
use App\Exceptions\ErrorException;
use App\Models\User;
use Carbon\CarbonImmutable;
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
            'name'        => ['required', 'string', 'max:50', 'cyrillic'],
            'surname'     => ['required', 'string', 'max:50', 'cyrillic'],
            'patronymic'  => ['nullable', 'string', 'max:50', 'cyrillic'],
            'date_birth'  => ['required', 'date'],
            'gender'      => ['required', 'string', 'max:7'],
            'email'       => ['required', 'email', 'max:50'],
            'phone'       => ['required', 'string', 'phone'],
            'messenger'   => ['required', 'string', 'max:15'],
            'left_type'   => ['nullable', 'string', 'max:25'],
            'right_type'  => ['nullable', 'string', 'max:25'],
            'left_level'  => ['nullable', 'string', 'max:25'],
            'right_level' => ['nullable', 'string', 'max:25'],
            'first_img'   => ['nullable', 'image', 'max:4048'],
            'second_img'  => ['nullable', 'image', 'max:4048'],
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
            'date_birth.required' => 'Не указана дата рождения',
            'date_birth.date'     => 'Не правильный формат',
            'gender.required'     => 'Не указан пол',
            'gender.max'          => 'Пол должен состоять максимум из 7 символов',
            'email.required'      => 'Вы ввели не email',
            'email.max'           => 'email должен состоять максимум из 50 символов',
            'phone.phone'         => 'Телефон должен состоять из цифр и начинаться на +7',
            'messenger.required'  => 'Мессенджер не указан',
            'messenger.max'       => 'Мессенджер должен состоять максимум из 15 символов',
            'left_type.max'       => 'Протезирование Левой стороны должно состоять максимум из 25 символов',
            'right_type.max'      => 'Протезирование Правой стороны должно состоять максимум из 25 символов',
            'left_level.max'      => 'Протезирование Левой руки должно состоять максимум из 25 символов',
            'right_level.max'     => 'Протезирование Правой руки должно состоять максимум из 25 символов',
            'first_img'           => 'Размер файла не должен превышать 4мб',
            'second_img'          => 'Размер файла не должен превышать 4мб',
        ];
    }

    /**
     * @return CreatePatientDTO
     * @throws BadRequestException
     */
    public function getDto(): CreatePatientDTO
    {
        if ($this->user()->role !== UserRoles::MASTER && $this->user()->role !== UserRoles::USER) {
            throw new BadRequestException(
                message: 'Возникла ошибка',
            );
        }

        if ($this->input('left_type') === 'null' && $this->input('right_type') === 'null') {
            throw new BadRequestException(
                message: 'Должна быть выбрана хоть одна сторона протезирования',
            );
        }

        return new CreatePatientDTO(
            dateBirth: CarbonImmutable::parse($this->input('date_birth')),
            gender: GenderType::tryFrom($this->input('gender')),
            messenger: MessengerType::tryFrom($this->input('messenger')),
            name: $this->input('name'),
            surname: $this->input('surname'),
            email: $this->input('email'),
            phone: $this->input('phone'),
            leftType: ProthesisType::tryFrom($this->input('left_type')),
            rightType: ProthesisType::tryFrom($this->input('right_type')),
            leftLevel: ProthesisLevel::tryFrom($this->input('left_level')) === ProthesisLevel::NOZZLE
                ? ProthesisLevel::WRIST_KNOT
                : ProthesisLevel::tryFrom($this->input('left_level')),
            rightLevel: ProthesisLevel::tryFrom($this->input('right_level')) === ProthesisLevel::NOZZLE
                ? ProthesisLevel::WRIST_KNOT
                : ProthesisLevel::tryFrom($this->input('right_level')),
            patronymic: $this->input('patronymic') ?? null,
            img: [$this->file('first_img'), $this->file('second_img')],
        );
    }
}
