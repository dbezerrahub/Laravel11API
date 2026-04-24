<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class ApiResponseException extends Exception
{
    protected int $status;
    protected array $data;

    public function __construct(string $message, int $status = 400, array $data = [])
    {
        parent::__construct($message);
        $this->status = $status;
        $this->data = $data;
    }

    public function render($request): JsonResponse
    {
        return response()->json([
            'message' => $this->getMessage(),
            'data' => $this->data
        ], $this->status);
    }
}