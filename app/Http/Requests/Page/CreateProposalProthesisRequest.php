<?php

namespace App\Http\Requests\Page;

use App\DTO\Page\CreateProposalProthesisDTO;
use App\Enum\AgePeriod;
use App\Enum\ProthesisFunction;
use App\Enum\ProthesisLevel;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateProposalProthesisRequest extends FormRequest
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
            'name'               => ['required', 'string', 'max:50', 'cyrillic'],
            'surname'            => ['required', 'string', 'max:50', 'cyrillic'],
            'patronymic'         => ['nullable', 'string', 'max:50', 'cyrillic'],
            'email'              => ['required', 'email', 'max:50'],
            'phone'              => ['required', 'string', 'max:12', 'phone'],
            'city'               => ['required', 'string', 'max:20'],
            'age_period'         => ['required', 'string', 'max:20'],
            'is_program'         => ['required', 'boolean'],
            'prothesis_function' => ['required', 'string'],
            'questions'          => ['nullable', 'string', 'max:1000'],
            'prosthesis_level'   => ['required', 'string', 'max:30'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.cyrillic'       => 'Имя должно состоять из русских букв',
            'surname.cyrillic'    => 'Фамилия должна состоять из русских букв',
            'patronymic.cyrillic' => 'Отчество должно состоять из русских букв',
            'email.email'         => 'Вы ввели неправильный email',
            'email.required'      => 'Вы не ввели email',
            'phone.phone'         => 'Вы ввели не правильный телефон',
            'phone.required'      => 'Вы не ввели телефон',
            'city.required'       => 'Вы не ввели город',
            'is_program.required' => 'Вы не выбрали вариант',
        ];
    }

    public function getDto(): CreateProposalProthesisDTO
    {
        return new CreateProposalProthesisDTO(
            agePeriod: AgePeriod::tryFrom($this->input('age_period')),
            level: ProthesisLevel::tryFrom($this->input('prosthesis_level')),
            function: ProthesisFunction::tryFrom($this->input('prothesis_function')),
            name: $this->input('name'),
            surname: $this->input('surname'),
            email: $this->input('email'),
            phone: $this->input('phone'),
            city: $this->input('city'),
            isProgram: $this->input('is_program'),
            patronymic: $this->input('patronymic'),
            questions: $this->input('questions'),
        );
    }
}
