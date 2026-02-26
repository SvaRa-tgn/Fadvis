<?php

namespace App\Http\Requests\Pdf\Order;

use App\DTO\Pdf\ResentOrderPdfDTO;
use App\Enum\UserRoles;
use App\Exceptions\BadRequestException;
use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ResendOrderPdfRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (!$this->getOrder()) {
            return false;
        }

        // Проверка прав доступа
        return $this->user()?->role === UserRoles::MASTER ||
            $this->user()?->id === $this->getOrder()->user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
        ];
    }

    /**
     * Сообщения ошибок валидации
     */
    public function messages(): array
    {
        return [
            'email.required' => 'Не указан email',
            'email.email'    => 'Это не email',
        ];
    }

    /**
     * Get the DTO after validation.
     */
    public function getDto(): ResentOrderPdfDTO
    {
        return new ResentOrderPdfDTO(
            order: $this->getOrder(),
            email: $this->input('email'),
        );
    }

    /**
     * Handle a failed authorization attempt.
     */
    protected function failedAuthorization()
    {
        throw new AccessDeniedHttpException('Доступ запрещен');
    }

    /**
     * Handle a failed validation attempt.
     */
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        // Для API возвращаем JSON с ошибками валидации
        throw new \Illuminate\Http\Exceptions\HttpResponseException(
            response()->json([
                'message' => 'Ошибка валидации',
                'errors' => $validator->errors()
            ], 422)
        );
    }

    private function getOrder(): ?Order
    {
        if (!$order = Order::where('number', $this->route('order'))->first()) {
            throw new NotFoundHttpException(
                message: 'Заказ не найден',
            );
        }

        return $order;
    }
}
