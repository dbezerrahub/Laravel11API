<?php
namespace App\Http\Controllers;
use App\Http\Requests\LoginRequest;
use App\Services\ApiResponseService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Services\ApiAuthenticationService;
class ApiAuthController extends Controller
{
    private ApiAuthenticationService $apiAuthenticationService;

    public function __construct()
    {
        $this->apiAuthenticationService = new ApiAuthenticationService();
    }

    public function login(LoginRequest $request)
    {
        $user = $this->apiAuthenticationService->validateUserClientId($request);
        $token = $this->apiAuthenticationService->createLoginToken($user);
        $this->apiAuthenticationService->deleteExpiredTokens();
        return ApiResponseService::show(["token" => $token], Response::HTTP_OK);
    }
}
