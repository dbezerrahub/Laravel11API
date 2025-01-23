<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Helpers\ModelHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Exception;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id'                => 'integer',
            'name'              => 'string',
            'email'             => 'string',
            'password'          => 'string',
            'remember_token'    => 'string',
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    /**
     * @param array $id_array
     * @param string $field_name nome do atributi a ser pesquisado
     * @return array array de nomes
     */
    static function get($search_field, $value_search_field) {
            // Usando DB retornará todos os atributos
            /*
             $users = DB::select(
                "SELECT * FROM users WHERE $search_field = '$value_search_field'"
            );
             */
            if(preg_match('/^\d+$/', $value_search_field)) {
                $value_search_field = (int) $value_search_field;
            }
            if(!ModelHelper::isSameType(User::class, $search_field, $value_search_field)) {
                return ["message" => "Os parâmetros de pesquisa não correspondem ao mesmo tipo"];
            }
            // Usando a classe user (Eloquent) não vai retornar os atributos hidden
            $users = User::where($search_field, $value_search_field)->get();
            return $users;
    }
}
