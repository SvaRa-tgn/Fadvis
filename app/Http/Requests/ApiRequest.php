<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;


class ApiRequest extends FormRequest
{
    /**
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator|\Illuminate\Contracts\Validation\Validator $validator): Validator
    {
        throw new HttpResponseException(
            new JsonResponse([
                'success' => false,
                'errors' => (new ValidationException($validator))->errors(),
            ],
            status: Response::HTTP_UNPROCESSABLE_ENTITY),
        );
    }
}
