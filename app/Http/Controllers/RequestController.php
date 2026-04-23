<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class RequestController extends Controller
{
    ###### User Interface ######
    ############################
    static function addUserRequestValidate($request)
    {
        $request->validate([
            'name'                  => 'required',
            'email'                 => 'required',
            'client_secret'         => 'required',
            'google_refresh_token'  => 'required'
        ]);
        return $request->toArray();
    }

    static function createUserKeyRequestValidate($request)
    {
        $request->validate([
            'email' => 'required'
        ]);
        return $request->toArray();
    }

    static function saveGoogleTokenRequestValidate($request)
    {
        $request->validate([
            'email'        => 'required',
            'google_token' => 'required'
        ]);
        return $request->toArray();
    }

    static function getGoogleRefreshTokenRequestValidate($request)
    {
        $request->validate([
            'email'        => 'required'
        ]);
        return $request->toArray();
    }

    ###### FrontAuthentication Interface ######
    ###########################################
    static function loginRequestValidate($request)
    {
        $request->validate([
            'client_id' => 'required',
            'client_secret' => 'required',
        ]);
        return $request->toArray();
    }

    ###### Invoice Interface ######
    ###############################
    static function extractInvoicesDataRequestValidate($request)
    {
        $request->validate([
            'invoice_string' => 'required',
            'email_from'     => 'required'
        ]);
        return $request->toArray();
    }
}
