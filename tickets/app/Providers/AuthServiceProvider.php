<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        'App\Model' => 'App\Policies\TicketPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('update-ticket', function($user, $ticket) {
            foreach($user->roles()->get() as $role) {
                if($role->slug == 'admin' || $user->id == $ticket->user_id) return true;
            }
            return false;
        });

        Gate::define('destroy-ticket', function($user, $ticket){
            return Gate::allows('update-ticket', $ticket);
        });

        Gate::define('show-ticket', function($user, $ticket){
            return $user->id == $ticket->user_id || $user->role()->slug == 'admin';
        });

        Gate::define('show-all-tickets', function($user){
            foreach($user->roles() as $role) {
                if ($role->slug == 'admin') {
                    return true;
                }
            }
            return false;
        });


    }
}
