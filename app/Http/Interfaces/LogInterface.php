<?php

namespace App\Http\Interfaces\Frontend;

use App\Exceptions\Handler;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ResponseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class LogInterface
{

    public function __construct()
    {

    }

    public function saveLog(Request $request) {
        $requestArray = $request->toArray();
        $Handler = new Handler();
        $Handler->saveLog($requestArray);
    }
}
