<?php

namespace App\Providers;

use App\Models\User;
use App\Services\SettingService;
use Carbon\Carbon;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
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
        $this->registerPolicies();

        $this->settingService = new SettingService();

        Gate::define('create-question', function (User $user) {
            return $user->questions()->whereDate('created_at', Carbon::today())->count() < $this->settingService->get('MAX_QUESTIONS_PER_DAY');
        });

        Gate::define('create-answer', function (User $user) {
            return $user->answers()->whereDate('created_at', Carbon::today())->count() < $this->settingService->get('MAX_ANSWERS_PER_DAY');
        });
    }
}
