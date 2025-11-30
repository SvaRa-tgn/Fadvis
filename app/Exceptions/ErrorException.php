<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ErrorException extends Exception
{
    public function render(Request $request): Response
    {
        return new JsonResponse([
            'code'    => Response::HTTP_NOT_FOUND,
            'message' => $this->getMessage(),
        ]);
    }
}
