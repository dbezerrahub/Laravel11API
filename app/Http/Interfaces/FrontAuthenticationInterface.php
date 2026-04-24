<?php
namespace App\Http\Interfaces;

use Illuminate\Http\Request;
use App\Http\Controllers\FrontAuthenticationController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ResponseController;

class FrontAuthenticationInterface
{
    private FrontAuthenticationController $frontAuthController;

    public function __construct()
    {
        $this->frontAuthController = new FrontAuthenticationController();
    }

    public function login(Request $request) 
    {
        $requestArray = RequestController::loginRequestValidate($request);
        $token = $this->frontAuthController->getToken($requestArray);
        return ResponseController::loginResponse($token);
    }

    public function getGoogleClientKeys(Request $request) 
    {
        $google_keys = $this->frontAuthController->getGoogleClientKeys();
        return ResponseController::getGoogleClientKeysResponse($google_keys);
    }
}