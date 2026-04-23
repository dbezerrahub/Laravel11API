<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use App\Models\DAO\FrontendDAO;

class Frontend extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = ['name', 'client_id', 'client_secret'];

    // Relacionamento com FrontendAuthorization
    public function frontendAuthorizations()
    {
        return $this->hasMany(EndpointAuthorization::class, 'id_frontend');
    }

    public static function find_first($where) {
        return FrontendDAO::select('find_first', $where);
    }
}
