<?php

namespace App\Utils\Formater;

class GeneralJsonResponseFormatter extends JsonResponseFormatter
{
    public function formatSuccessResponse($data = null, $message = null)
    {
        return $this->formatResponse(200, true, $data, [], $message);
    }

    public function formatSuccessResponseWithKey($dataKey = 'data', $dataValue = null, $message = null)
    {
        return $this->formatResponseWithKey(
            200,
            true,
            $dataKey,
            $dataValue,
            [],
            $message
        );
    }


    public function formatErrorResponse($statusCode, $message = null, $error = [])
    {
        return $this->formatResponse($statusCode, false, null, $error, $message);
    }
}
