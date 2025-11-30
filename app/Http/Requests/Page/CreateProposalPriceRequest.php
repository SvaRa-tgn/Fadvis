<?php

namespace App\Http\Requests\Page;

use App\DTO\Page\CreateProposalPriceDTO;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateProposalPriceRequest extends FormRequest
{
    /** Determine if the user is authorized to make this request. */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'         => ['required', 'string', 'max:50', 'cyrillic'],
            'surname'      => ['required', 'string', 'max:50', 'cyrillic'],
            'patronymic'   => ['nullable', 'string', 'max:50', 'cyrillic'],
            'email'        => ['required', 'email', 'max:50'],
            'phone'        => ['required', 'string', 'max:12', 'phone'],
            'organization' => ['required', 'string', 'max:50'],
            'city'         => ['required', 'string', 'max:20'],
            'interest'     => ['nullable', 'string', 'max:255', 'cyrillic'],
            'questions'    => ['nullable', 'string', 'max:500', 'cyrillic'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.cyrillic'       => 'Имя должно состоять из русских букв',
            'surname.cyrillic'    => 'Фамилия должна состоять из русских букв',
            'patronymic.cyrillic' => 'Отчество должно состоять из русских букв',
            'email'               => 'Вы ввели неправильный email',
            'phone'               => 'Вы ввели не правильный телефон',
            'interest.cyrillic'   => 'Поле должно состоять из русских букв',
            'questions.cyrillic'  => 'Поле должно состоять из русских букв',
        ];
    }

    public function getDto(): CreateProposalPriceDTO
    {
        return new CreateProposalPriceDTO(
            name: $this->input('name'),
            surname: $this->input('surname'),
            email: $this->input('email'),
            phone: $this->input('phone'),
            organization: $this->input('organization'),
            city: $this->input('city'),
            patronymic: $this->input('patronymic'),
            interest: $this->input('interest'),
            questions: $this->input('questions'),
        );
    }
}
