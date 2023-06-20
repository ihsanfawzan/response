<?php

namespace Ihsanfawzan\Response;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response as SymfonyResponse;
use Illuminate\Validation\ValidationException;
use Response\FailedResponse;
use Response\SuccessResponse;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Response
{
    public function success(
        $data = [],
        $message = 'success',
        $code = 200,
        $headers = []
    ): Responsable {
        return new SuccessResponse(
            $data,
            $message,
            $code,
            $headers,
        );
    }

    public function failed(
        ?Throwable $e = null,
        $message = 'Error has been occured',
        $code = SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR,
        $headers = [],
        $errors = []
    ): Responsable {
        return new FailedResponse(
            $e,
            $message,
            $code,
            $headers,
            $errors,
        );
    }

    public function handle(Exception $e)
    {
        return match (true) {
            $e instanceof AuthenticationException => new FailedResponse(
                $e,
                message: 'Login to gain access',
                code: SymfonyResponse::HTTP_UNAUTHORIZED
            ),
            $e instanceof QueryException => new FailedResponse(
                $e,
                message: 'Query error',
                code: SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR,
            ),
            $e instanceof NotFoundHttpException => new FailedResponse(
                $e,
                message: 'Data tidak ditemukan',
                code: SymfonyResponse::HTTP_NOT_FOUND
            ),
            $e instanceof ValidationException => new FailedResponse(
                $e,
                message: 'Validation error',
                code: SymfonyResponse::HTTP_UNPROCESSABLE_ENTITY,
                errors: $e->errors(),
            ),
            $e instanceof MethodNotAllowedHttpException => new FailedResponse(
                $e,
                message: 'Method not allowed',
                code: SymfonyResponse::HTTP_METHOD_NOT_ALLOWED,
            ),
            default => new FailedResponse($e),
        };
    }
}
