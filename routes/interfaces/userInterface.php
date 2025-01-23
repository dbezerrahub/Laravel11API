<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckHttpResponse;

#Route::middleware([CheckHttpResponse::class])->group(function () {
    Route::get('/user-interface/get-users', function (Request $request) {
        $userController = new UserController();
        # Obtem os usuários baseado no parâmetro search_field
        $users = $userController->getUsers(
            $request['search_field'], 
            $request['value_search_field']
        ); 

        return response()->json($users);
    });
#});