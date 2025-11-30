<?php

namespace App\Http\Requests\Profile\Patient;

use App\DTO\Profile\Patient\UpdatePatientDTO;
use App\Models\Patient;
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
            'name'       => ['nullable', 'string', 'max:50', 'cyrillic'],
            'surname'    => ['nullable', 'string', 'max:50', 'cyrillic'],
            'patronymic' => ['nullable', 'string', 'max:50', 'cyrillic'],
            'email'      => ['nullable', 'string', 'email', 'max:50'],
            'phone'      => ['nullable', 'string', 'string', 'phone'],
        ];
    }

    /** Сообщения ошибок валидации */
    public function messages(): array
    {
        return [
            'name.cyrillic'       => 'Имя должно состоять из русских букв',
            'surname.cyrillic'    => 'Фамилия должна быть обязательно',
            'patronymic.cyrillic' => 'Отчество должно состоять из русских букв',
            'email.max'           => 'email должен состоять максимум из 50 символов',
            'phone.phone'         => 'Телефон должен состоять из цифр и начинаться на +7',
            'first_img'           => 'Размер файла не должен превышать 4мб',
            'second_img'          => 'Размер файла не должен превышать 4мб',
        ];
    }

    public function getDto(): UpdatePatientDTO
    {
        return new UpdatePatientDTO(
            patient: Patient::find($this->route('patient')),
            name: $this->input('name'),
            surname: $this->input('surname'),
            email: $this->input('email'),
            phone: $this->input('phone'),
            patronymic: $this->input('patronymic') ?? null,
        );
    }

}
