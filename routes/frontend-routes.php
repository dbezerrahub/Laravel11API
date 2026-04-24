<?php

use App\Http\Services\ApiAuthentication\ApiAuthenticationServiceInterface;
use Illuminate\Support\Facades\Route;
use App\Http\Interfaces\FrontAuthenticationInterface;

use App\Http\Interfaces\Frontend\LogInterface;

#### Autenticação pelo Sanctum ####
Route::middleware('auth:sanctum')->group(function () {
    #### Autorização de rotas (definido no banco de dados) ####
    # Acionar php artisan db:seed --class=FrontendAuthorizationTableSeeder para atualizar rotas no banco
    Route::middleware('EndpointAuthorizationMiddleware')->group(function () {

        ###### UserInterface ######
        Route::prefix('app/user-interface')->group(function () {
            
        });

        ###### LogInterface ######
        Route::prefix('app/log-interface')->group(function () {
            Route::post('save-log', [LogInterface::class, 'saveLog'])->name('saveLog');
        });

        ###### Email Interface ######
        Route::prefix('app/email-interface')->group(function () {
            #Route::post('send-with-mailgun', [EmailInterface::class, 'sendWithMailgun'])->name('sendWithMailgun');
        });
    });
});

#################################################
############## Somente Autorização ##############

###### AuthenticationInterface ######
Route::middleware('EndpointAuthorizationMiddleware')->group(function () {
    Route::prefix('auth-interface')->group(function () {
        Route::post('login', [ApiAuthenticationServiceInterface::class, 'login'])->name('login');
    });
});

###### HelperInterface ######
Route::middleware('EndpointAuthorizationMiddleware')->group(function () {
    Route::prefix('app/helper-interface')->group(function () {
        #Route::get('get-datetime-info', [HelperInterface::class, 'getDateTimeInfo'])->name('getDateTimeInfo');
    });
});
###### EmailInterface não autenticável ######
Route::middleware('EndpointAuthorizationMiddleware')->group(function () {
    Route::prefix('app/email-interface')->group(function () {
        #Route::post('check-email-connection', [EmailInterface::class, 'checkEmailConnection'])->name('checkEmailConnection');
    });
});
###### UserInterface ######
Route::middleware('EndpointAuthorizationMiddleware')->group(function () {
    Route::prefix('app/user-interface')->group(function () {
        #Route::post('add-user', [UserInterface::class, 'addUser'])->name('addUser');
        #Route::post('create-user-key', [UserInterface::class, 'createUserKey'])->name('createUserKey');
        #Route::post('save-google-token', [UserInterface::class, 'saveGoogleToken'])->name('saveGoogleToken');

    });
});


###### Teste Interface #######
Route::middleware('EndpointAuthorizationMiddleware')->group(function () {
    Route::prefix('app/teste-interface')->group(function () {
        #Route::post('teste', [TesteInterface::class, 'teste'])->name('teste');
    });
});

###### ContactInterface ######
Route::middleware('EndpointAuthorizationMiddleware')->group(function () {
    Route::prefix('app/contact-interface')->group(function () {
        #Route::post('send-contact-email', [ContactInterface::class, 'sendContactEmail'])->name('sendContactEmail');
    });
});
