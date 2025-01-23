<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;

class ModelHelper
{
    static function isSameType($class, $att, $value) {
        $u = new $class();
        $castType = $u->getCasts()[$att];
        switch ($castType) {
            case 'integer':
                return is_int($value);
            case 'boolean':
                return is_bool($value);
            case 'datetime':
                return $value instanceof \DateTimeInterface || strtotime($value) !== false;
            case 'float':
            case 'double':
                return is_float($value);
            case 'array':
                return is_array($value);
            case 'object':
                return is_object($value);
            case 'string':
                return is_string($value);
            default:
                return false; // Para casts personalizados
        }
    }
}
