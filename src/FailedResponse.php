<?php

namespace Response;

use Throwable;
use Illuminate\Http\Response;
use Illuminate\Contracts\Support\Responsable;

class FailedResponse implements Responsable
{

    public function __construct(
        private ?Throwable $e = null,
        private $message = 'Error has been occured',
        private $code = Response::HTTP_INTERNAL_SERVER_ERROR,
        private $headers = [],
        private $errors = []
    ) {
    }

    public function toResponse($request)
    {
        $response = [
            'code' => $this->code,
            'status' => false,
            'message' => $this->message,
        ];

        if (count($this->errors) > 0) {
            $response['errors'] = $this->errors;
        }

        if ($this->e) {
            report($this->e);
            if (config('app.debug')) {
                $response['debug'] = [
                    'message' => $this->e->getMessage(),
                    'trace' => $this->e->getTrace(),
                ];
            }
        }

        return response()->json($response, $this->code, $this->headers);
    }
}
