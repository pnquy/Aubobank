<?php

namespace App\Utils\Formater;

abstract class JsonResponseFormatter
{
    protected function formatResponse($statusCode, $success, $data = null, $error = [], $message = null)
    {
        return [
            'statusCode' => $statusCode,
            'success' => $success,
            'data' => $data,
            'error' => $error,
            'message' => $message,
        ];
    }

    protected function formatResponseWithKey($statusCode, $success, $key = 'data', $value = null, $error = [], $message = null)
    {
        return [
            'statusCode' => $statusCode,
            'success' => $success,
            $key => $value,
            'error' => $error,
            'message' => $message,
        ];
    }


    abstract public function formatSuccessResponse($data = null, $message = null);

    abstract public function formatErrorResponse($statusCode, $message = null, $error = []);
}
