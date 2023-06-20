<?php

namespace Response;

use Illuminate\Contracts\Support\Responsable;


class SuccessResponse implements Responsable
{

    public function __construct(
        protected $data = [],
        protected $message = 'success',
        protected $code = 200,
        protected $headers = []
    ) {
    }

    public function toResponse($request)
    {
        return response()->json([
            'code' => $this->code,
            'status' => true,
            'message' => $this->message,
            'data' => $this->data,
        ], $this->code, $this->headers);
    }
}
