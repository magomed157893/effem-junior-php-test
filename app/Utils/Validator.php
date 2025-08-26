<?php

namespace App\Utils;

use Exception;

class Validator
{
    public static function check(bool $ok, string $message)
    {
        if (!$ok) {
            throw new \Exception($message);
        }
    }

    public static function canBeString(mixed $value)
    {
        return is_null($value) || is_scalar($value);
    }

    public static function notBlank(string|null $value)
    {
        return !empty($value) && strlen(trim($value));
    }

    public static function maxChars(string $value, int $n)
    {
        return mb_strlen($value) <= $n;
    }

    public static function trueOrFalse(mixed &$value)
    {
        if (is_bool($value) || (is_numeric($value) && ($value === 1 || $value === 0))) {
            $value = $value ? 1 : 0;
            return true;
        }

        return false;
    }
}
