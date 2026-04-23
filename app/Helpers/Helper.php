<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Helper
{
    /**
     * Verifica se o valor passado é do mesmo tipo do atributo da classe
     */
    static function isSameType($class, $att, $value)
    {
        if (preg_match('/^\d+$/', $value)) {
            $value = (int) $value;
        }
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

    static function getDateTimeInfo()
    {
        $microtime = microtime(true);
        $milliseconds = round(($microtime - floor($microtime)) * 10000); // Obtém os milissegundos
        if (strlen($milliseconds) <= 3) {
            $milliseconds = '1' . $milliseconds;
        }
        return [
            'date_br' => date('d/m/Y'),
            'date_bd' => date('Y-m-d'),
            'year' => date('Y'),
            'month' => date('m'),
            'day' => date('d'),
            'hour' => date('H'),
            'minutes' => date('i'),
            'seconds' => date('s'),
            'milliseconds' => "$milliseconds"
        ];
    }

    static function stringToHexNumber($str)
    {
        $hash = 0;
        for ($i = 0; $i < strlen($str); $i++) {
            $hash = ($hash << 5) - $hash + ord($str[$i]);
            $hash = $hash & 0xFFFFFF;
        }
        return "0x" . str_pad(dechex($hash), 6, '0', STR_PAD_LEFT);
    }



    static function encryptAES($text, $key, $iv)
    {
        $encrypted = openssl_encrypt(
            $text,
            'AES-256-CBC',
            $key,
            OPENSSL_RAW_DATA,
            $iv
        );
        return base64_encode($encrypted);
    }


    static function decryptAES($encryptedText, $key, $iv)
    {
        $cipher = "AES-256-CBC";
        $options = 0;
        $decrypted = openssl_decrypt($encryptedText, $cipher, $key, $options, $iv);
        return $decrypted;
    }

    static function formatPersonalName($name)
    {
        // Title Case seguro para UTF-8
        $name = mb_convert_case(mb_strtolower($name, 'UTF-8'), MB_CASE_TITLE, 'UTF-8');

        // Partículas que devem ficar minúsculas em nomes PT-BR
        $regex = '/\b(Da|De|Do|Dos|Das|E)\b/u';

        $name = preg_replace_callback($regex, function ($m) {
            return mb_strtolower($m[0], 'UTF-8');
        }, $name);

        return $name;
    }

    static function getFirstAndLastName(string $name): string {
        $name = trim(preg_replace('/\s+/', ' ', $name));
        $parts = explode(' ', $name);
        if (count($parts) === 1) {
            return $parts[0]; // só tem um nome
        }
    
        $firstName = $parts[0];
        $lastName   = $parts[count($parts) - 1];
    
        return $firstName . ' ' . $lastName;
    }

    static function base64UrlDecode($input)
    {
        $remainder = strlen($input) % 4;
        if ($remainder) {
            $padLen = 4 - $remainder;
            $input .= str_repeat('=', $padLen);
        }
        $input = strtr($input, '-_', '+/');
        return base64_decode($input);
    }
}
