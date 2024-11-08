<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        \App\Models\Payment::class => \App\Policies\PaymentPolicy::class,
    ];
    

    public function boot()
    {
        $this->registerPolicies();

        // Ajoutez ici vos Gates et Policies
    }
}
