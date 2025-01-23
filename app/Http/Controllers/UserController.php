<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * @param String $search_field
     * @param String $value_search_field
     * @return array array de atributos do user
     */
    function getUsers($search_field, $value_search_field) {
        $users = User::get($search_field, $value_search_field);
        return $users;
    }
}