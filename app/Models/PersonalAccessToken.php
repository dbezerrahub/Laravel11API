<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DAO\PersonalAccessTokenDAO;
use Carbon\Carbon;

class PersonalAccessToken extends Model
{
    public static function deleteExpiredTokens() {
        $qtd_deleted_tokens = PersonalAccessTokenDAO::delete('object', [['where','expires_at','<',Carbon::now()],['orwhere','expires_at',null]]);
        return response()->json(['deleteExpiredApiTokens'=>"$qtd_deleted_tokens api tokens deletados"]);
    }
}
