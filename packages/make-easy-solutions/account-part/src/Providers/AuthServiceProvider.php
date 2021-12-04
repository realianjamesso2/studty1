<?php

namespace MakeEasySolutions\AccountPart\Providers; 

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        //$setting = Setting::where('setting','Session')->first();
        $this->registerPolicies();
        Passport::routes();
        //Passport::personalAccessTokensExpireIn(now()->addSeconds($setting->value));
        
       
    }
}
