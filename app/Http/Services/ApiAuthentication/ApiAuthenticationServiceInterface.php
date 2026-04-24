<?php
namespace App\Http\Services\ApiAuthentication;

use App\Http\Services\ApiAuthentication\ApiAuthenticationServiceController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Services\ResponseApi;

class ApiAuthenticationServiceInterface
{
    private ApiAuthenticationServiceController $apiAuthenticationServiceController;

    public function __construct()
    {
        $this->apiAuthenticationServiceController = new ApiAuthenticationServiceController();
    }

    public function login(Request $request) 
    {
        $requestArray = $this->apiAuthenticationServiceController->loginRequestValidation($request);
        $user = $this->apiAuthenticationServiceController->validateUserClientId($requestArray);
        $token = $this->apiAuthenticationServiceController->createLoginToken($user);
        $this->apiAuthenticationServiceController->deleteExpiredTokens();
        return ResponseApi::show(["token"=>$token], Response::HTTP_OK);
    }
}