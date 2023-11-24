<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class BaseApiException extends Exception
{
    /**
     * Create a new exception instance.
     *
     * @param string $message
     * @param int $code
     * @param Exception|null $previous
     */
    public function __construct($message = "", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function render(): JsonResponse
    {
        return response()->json([
            'error' => [
                'message' => $this->getMessage(),
                'code'    => $this->getCode(),
            ],
        ], $this->getCode());
    }
}
