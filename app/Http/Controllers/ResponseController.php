<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class ResponseController extends Controller
{
    static function genericResponse(Array $msg) {
        return response()->json(
            $msg,
            response::HTTP_OK
        );
    }

    ###### User Interface ######
     ##########################
    static function addUserResponse($add_user) {
        if(!$add_user) {
            return response()->json(
                [
                    "message" => "Usuário já cadastrado",
                ],
                response::HTTP_OK
            );
        }
        return response()->json(
            [
                "message" => "Usuário cadastrado com sucesso",
                "user_id" => $add_user->id
            ],
            response::HTTP_OK
        );
        
    }

    static function createUserKeyResponse($milliseconds, $response) {
        return response()->json(
            [
                "message"       => "key criada com sucesso",
                "milliseconds"  => $milliseconds,
                "response" =>$response
            ],
            response::HTTP_OK
        );
    }

    static function saveGoogleTokenResponse() {
        return response()->json(
            [
                "message"       => "key salva com sucesso"
            ],
            response::HTTP_OK
        );
    }

    static function getGoogleRefreshTokenResponse($google_refresh_token) {
        return response()->json(
            [
                "google_refresh_token" => $google_refresh_token
            ],
            response::HTTP_OK
        );
    }

    ###### FrontAuthentication Interface ######
     #########################################
     
     static function loginResponse($token) {
        if($token) {
            return response()->json(
                ["token"=>$token], 
                response::HTTP_OK
            );
        }
        return response()->json(
            ["message"=>'As credenciais fornecidas (client_id/client_secret) estão incorretas'], 
            response::HTTP_BAD_REQUEST
        );
    }

    static function getGoogleClientKeysResponse($google_keys) {
        return response()->json(
            [
                "GOOGLE_CLIENT_ID"=>$google_keys['GOOGLE_CLIENT_ID'],
                "GOOGLE_CLIENT_SECRET"=>$google_keys['GOOGLE_CLIENT_SECRET']
            ], 
            response::HTTP_OK
        );
    }

     ###### Invoice Interface ######
      #############################
      
     
}
