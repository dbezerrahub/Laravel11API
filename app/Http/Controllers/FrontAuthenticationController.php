<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PersonalAccessToken;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Hash;

class FrontAuthenticationController extends Controller
{
    public function getToken(Array $request)
    {
        $user = User::find_first([['where', 'email', '=', $request['client_id']]]);
        $request_client_secret = hash('sha256', $request['client_secret']);
        $user_client_secret = $user->client_secret;        
        if (!$user || $request_client_secret != $user_client_secret) {
            ### retirando a verificação para facilitar testes no postman
            // return false;
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        $token_id = explode('|', $token)[0];
        $personalAccessToken = PersonalAccessToken::find($token_id);
        $personalAccessToken->expires_at = Carbon::now()->addHours(1);
        $personalAccessToken->save();
        PersonalAccessToken::deleteExpiredTokens();
        return $token;
    }

    function createClientSecret($email, $milliseconds)
    {
        $HANDSHAKE_AES_KEY = env('HANDSHAKE_AES_KEY');
        $iv = $milliseconds . $milliseconds . $milliseconds . $milliseconds;
        $iv = substr(Helper::encryptAES($email, $HANDSHAKE_AES_KEY, $iv), 0, 16);
        $hexArray = [
            '_0x40a1cf',
            '0x12d6+',
            'parseInt',
            '_0x5F6A_',
            '(-0xB8C1_)',
            '(0xB,8C1)+',
            '0x48E9_',
            '(0x101,crTE)',
            '0x2B7D',
            '0x6D1A'
        ];
        $k1 = '';
        for ($i = 0; $i < strlen($milliseconds); $i++) {
            $index = intval($milliseconds[$i]);
            if (isset($hexArray[$index])) {
                $k1 .= $hexArray[$index];
            }
        }
        $HANDSHAKE_AES_KEY = env('HANDSHAKE_AES_KEY');
        $k2 = Helper::encryptAES($k1, $HANDSHAKE_AES_KEY, $iv);
        $k2 = hash('sha256', $k2);
        $k2 = hash('sha256', $k2);
        return ['k2' => $k2, 'k1' => $k1];
    }

    function getGoogleClientKeys()
    {
        return [
            'GOOGLE_CLIENT_ID'      => env('GOOGLE_CLIENT_ID'),
            'GOOGLE_CLIENT_SECRET'  => env('GOOGLE_CLIENT_SECRET')
        ];
    }
}
