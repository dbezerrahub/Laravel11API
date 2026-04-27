<?php
namespace App\Services;

class ApiResponseService {
    static function show($array_data, $http_code) {
        return response()->json($array_data, $http_code);
    }
}