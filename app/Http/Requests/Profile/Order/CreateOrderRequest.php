<?php

namespace App\Http\Requests\Profile\Order;

use App\DTO\Profile\Order\CreateOrderDTO;
use App\Enum\ProthesisSide;
use App\Enum\ProthesisType;
use App\Enum\UserRoles;
use App\Exceptions\ErrorException;
use App\Models\Patient;
use Illuminate\Foundation\Http\FormRequest;
use Random\RandomException;

class CreateOrderRequest extends FormRequest
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
            'patient'    => ['required', 'integer', 'exists:patients,id'],
            'side'       => ['required', 'string'],
            'left_type'  => ['nullable', 'string'],
            'right_type' => ['nullable', 'string'],
        ];
    }

    /** DTO после валидации данных
     * @throws ErrorException
     * @throws RandomException
     */
    public function getDto(): CreateOrderDTO
    {
        if ($this->user()->role !== UserRoles::USER->value) {
            throw new ErrorException(
                message: 'Страница не найдена',
            );
        }

        $random = bin2hex(random_bytes(4));
        $data = $this->user()->id . $random;
        $number = 'FDV_' . strtoupper(substr(md5($data), 0, 8))
            . '_' . $this->user()->id . '/' . date('d.m.Y');

        return new CreateOrderDTO(
            patient: Patient::find($this->input('patient')),
            side: ProthesisSide::tryFrom($this->input('side')),
            number: $number,
            left_type: ProthesisType::tryFrom($this->input('left_type')),
            right_type: ProthesisType::tryFrom($this->input('right_type')),
        );
    }
}
