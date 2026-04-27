<?php
namespace App\Services;

use App\Exceptions\Handler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Services\ResponseApi;

class TestService
{

    public function saveLog(Request $request) {
        $requestArray = $request->toArray();
        $Handler = new Handler();
        $Handler->saveLog($requestArray);
    }
}