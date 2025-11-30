<?php

namespace App\Http\Requests\Profile\Order;

use App\DTO\Profile\Order\CreateOrderDTO;
use App\Enum\ProthesisSide;
use App\Enum\UserRoles;
use App\Exceptions\ErrorException;
use App\Models\Patient;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'number'     => ['required', 'string'],
            'user_id'    => ['required', 'integer', 'exists:users,id'],
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'side'       => ['required', 'string'],
            'left_type'  => ['nullable', 'string'],
            'right_type' => ['nullable', 'string'],
        ];
    }

    /** DTO после валидации данных
     * @throws ErrorException
     */
    public function getDto(): CreateOrderDTO
    {
        if ($this->user()->role !== UserRoles::USER->value) {
            throw new ErrorException(
                message: 'Страница не найдена',
            );
        }

        return new CreateOrderDTO(
            patient: Patient::find($this->input('patient_id')),
            side: ProthesisSide::tryFrom($this->input('side')),
            number: $this->input('number'),
            left_type: $this->input('left_type'),
            right_type: $this->input('right_type'),
        );
    }
}
