<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class ArrayObjectHelper
{
    public function camelCaseToSnakeCase($camelCaseArray)
    {
        $snakeCaseArray = [];
        foreach ($camelCaseArray as $key => $value) {
            $snake_key = Str::snake($key);
            $snakeCaseArray[$snake_key] = $value;
        }
        return $snakeCaseArray;
    }
}
