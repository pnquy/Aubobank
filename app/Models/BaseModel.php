<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Helpers\ArrayObjectHelper;


abstract class BaseModel extends Model
{
    use HasFactory;

    public function getAttribute($key)
    {
        $snakeKey = Str::snake($key);
        return parent::getAttribute($snakeKey);
    }


    public function setAttribute($key, $value)
    {
        $snakeKey = Str::snake($key);
        parent::setAttribute($snakeKey, $value);
    }

    public function getRelationValue($key)
    {
        $snakeKey = Str::camel($key);
        return parent::getRelationValue($snakeKey);
    }

    static function createNewRecord($data)
    {
        $arrayObjectHelper = new ArrayObjectHelper();
        $fillData = $arrayObjectHelper->camelCaseToSnakeCase($data);
        return self::newRecord($fillData);
    }


    static function newRecord($data)
    {
        $record = new static();
        $record->fill($data);
        $record->save();
        return $record;
    }

    public function updateRecord($data)
    {
        $arrayObjectHelper = new ArrayObjectHelper();
        $fillData = $fillData = $arrayObjectHelper->camelCaseToSnakeCase($data);
        return self::update($fillData);
    }
}
