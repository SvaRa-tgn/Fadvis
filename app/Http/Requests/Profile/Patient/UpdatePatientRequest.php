<?php

namespace App\Http\Requests\Profile\Patient;

use App\DTO\Profile\Patient\UpdatePatientDTO;
use App\Enum\GenderType;
use App\Enum\MessengerType;
use App\Enum\ProthesisLevel;
use App\Enum\ProthesisType;
use App\Enum\UserRoles;
use App\Exceptions\BadRequestException;
use App\Exceptions\ErrorException;
use App\Models\Patient;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePatientRequest extends FormRequest
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
            'name'        => ['nullable', 'string', 'max:50', 'cyrillic'],
            'surname'     => ['nullable', 'string', 'max:50', 'cyrillic'],
            'patronymic'  => ['nullable', 'string', 'max:50', 'cyrillic'],
            'date_birth'  => ['nullable', 'date'],
            'gender'      => ['nullable', 'string', 'max:7'],
            'email'       => ['nullable', 'email', 'max:50'],
            'phone'       => ['nullable', 'string', 'phone'],
            'messenger'   => ['nullable', 'string', 'max:15'],
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
            'surname.cyrillic'    => 'Фамилия должна состоять из русских букв',
            'patronymic.cyrillic' => 'Отчество должно состоять из русских букв',
            'date_birth.date'     => 'Не правильный формат',
            'gender.max'          => 'Пол должен состоять максимум из 7 символов',
            'email.max'           => 'email должен состоять максимум из 50 символов',
            'phone.phone'         => 'Телефон должен состоять из цифр и начинаться на +7',
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
     * @return UpdatePatientDTO
     * @throws BadRequestException
     */
    public function getDto(): UpdatePatientDTO
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

        return new UpdatePatientDTO(
            patient: Patient::find($this->route('patient')),
            messenger: MessengerType::tryFrom($this->input('messenger')),
            leftType: ProthesisType::tryFrom($this->input('left_type')),
            rightType: ProthesisType::tryFrom($this->input('right_type')),
            leftLevel: ProthesisLevel::tryFrom($this->input('left_level')) === ProthesisLevel::NOZZLE
                ? ProthesisLevel::WRIST_KNOT
                : ProthesisLevel::tryFrom($this->input('left_level')),
            rightLevel: ProthesisLevel::tryFrom($this->input('right_level')) === ProthesisLevel::NOZZLE
                ? ProthesisLevel::WRIST_KNOT
                : ProthesisLevel::tryFrom($this->input('right_level')),
            dateBirth: CarbonImmutable::parse($this->input('date_birth')),
            gender: GenderType::tryFrom($this->input('gender')),
            name: $this->input('name'),
            surname: $this->input('surname'),
            patronymic: $this->input('patronymic') ?? null,
            email: $this->input('email'),
            phone: $this->input('phone'),
            img: [$this->file('first_img'), $this->file('second_img')],
        );
    }

}
