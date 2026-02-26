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
            'left_products'  => ['nullable', 'array', 'min:1'],
            'right_products' => ['nullable', 'array', 'min:1'],
            'description'    => ['nullable', 'string', 'max:2000'],
        ];
    }

    /** DTO после валидации данных
     * @throws ErrorException
     * @throws RandomException
     */
    public function getDto(): CreateOrderDTO
    {

        if ($this->user()->role !== UserRoles::USER) {
            throw new ErrorException(
                message: 'Страница не найдена',
            );
        }

        if (empty($this->input('left_products')) && empty($this->input('right_products'))) {
            throw new ErrorException(
                message: 'Не переданы товары',
            );
        }

        $patient = Patient::find($this->route('patient'));

        if (!$patient || $patient->user_id !== $this->user()->id) {
            throw new ErrorException(
                message: 'Пациент не найден',
            );
        }

        $random = bin2hex(random_bytes(4));
        $data = $this->user()->id . $random;
        $number = 'FDV_' . strtoupper(substr(md5($data), 0, 8)) . '_' . $this->user()->id;

        return new CreateOrderDTO(
            user: $this->user(),
            patient: $patient,
            number: $number,
            leftProducts: $this->input('left_products'),
            rightProducts: $this->input('right_products'),
            description: $this->input('description') ?? null,
        );
    }
}
