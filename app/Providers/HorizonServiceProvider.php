<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Laravel\Horizon\Horizon;
use Laravel\Horizon\HorizonApplicationServiceProvider;

class HorizonServiceProvider extends HorizonApplicationServiceProvider
{
    public function boot(): void
    {
        parent::boot();

        // Permitir acesso se o admin estiver logado
        Horizon::auth(function ($request) {
            return Auth::guard('admin')->check();
        });
    }
}
