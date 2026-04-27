<?php
namespace App\Http\Controllers;

use App\Services\ApiResponseService;
use App\Services\TestService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TestController extends Controller
{
    private TestService $test_service;

    public function __construct()
    {
        $this->test_service = new TestService();
    }

    public function print_request(Request $request)
    {
        $request_array = $request->toArray();
        return ApiResponseService::show($request_array, Response::HTTP_OK);
    }
}
