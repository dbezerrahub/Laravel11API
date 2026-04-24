<?php
namespace App\Http\Services;

class ResponseApi {
    static function show($json_data, $http_code) {
        return response()->json($json_data, $http_code);
    }
}