<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use TCG\Voyager\Models\Role;

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
        Gate::define('browse_other_download_list', function ($user) {
            return $user->hasPermission('browse_other_download_list');
        });
        Gate::define('browse_syllabus-lists', function ($user) {
            return $user->hasPermission('browse_syllabus-lists');
        });
        Gate::define('browse_assignment-lists', function ($user) {
            return $user->hasPermission('browse_assignment-lists');
        });
        Gate::define('browse_studyMaterial-lists', function ($user) {
            return $user->hasPermission('browse_studyMaterial-lists');
        });
        Gate::define('browse_certificates-index', function ($user) {
            return $user->hasPermission('browse_certificates-index');
        });
        Gate::define('browse_id-card-index', function ($user) {
            return $user->hasPermission('browse_id-card-index');
        });
        Gate::define('browse_search-expenses-index', function ($user) {
            return $user->hasPermission('browse_search-expenses-index');
        });
        Gate::define('browse_balance-fees-index', function ($user) {
            return $user->hasPermission('browse_balance-fees-index');
        });
        Gate::define('browse_student-fee-master', function ($user) {
            return $user->hasPermission('browse_student-fee-master');
        });
        Gate::define('browse_student-due-fees', function ($user) {
            return $user->hasPermission('browse_student-due-fees');
        });
        Gate::define('browse_fees-forward-index', function ($user) {
            return $user->hasPermission('browse_fees-forward-index');
        });
        Gate::define('browse_fees-statement-index', function ($user) {
            return $user->hasPermission('browse_fees-statement-index');
        });
        Gate::define('browse_student-fee', function ($user) {
            return $user->hasPermission('browse_student-fee');
        });
        Gate::define('browse_search-incomes-index', function ($user) {
            return $user->hasPermission('browse_search-incomes-index');
        });
        Gate::define('browse_staff-add-library', function ($user) {
            return $user->hasPermission('browse_staff-add-library');
        });
        Gate::define('browse_student-add-library', function ($user) {
            return $user->hasPermission('browse_student-add-library');
        });
        Gate::define('browse_staff-directory', function ($user) {
            return $user->hasPermission('browse_staff-directory');
        });
        Gate::define('browse_student-report', function ($user) {
            return $user->hasPermission('browse_student-report');
        });
        Gate::define('browse_guardian-report', function ($user) {
            return $user->hasPermission('browse_guardian-report');
        });
        Gate::define('browse_student-history', function ($user) {
            return $user->hasPermission('browse_student-history');
        });
        Gate::define('browse_searchStudentAttendence', function ($user) {
            return $user->hasPermission('browse_searchStudentAttendence');
        });
        Gate::define('browse_studentIdCard', function ($user) {
            return $user->hasPermission('browse_studentIdCard');
        });
        Gate::define('browse_teachers', function ($user) {
            return $user->hasPermission('browse_teachers');
        });
        Gate::define('browse_fee-manager-by-user', function ($user) {
            return $user->hasPermission('browse_fee-manager-by-user');
        });
        Gate::define('browse_student-attendence-by-user', function ($user) {
            return $user->hasPermission('browse_student-attendence-by-user');
        });
        /*$user = Auth::user();
        if (! app()->runningInConsole()) {
            $roles = Role::with('permissions')->get();

            foreach ($roles as $role) {
                foreach ($role->permissions as $permission) {

                    $permissionArray[$permission->key][] = $role->id;
                }
            }

            foreach ($permissionArray as $title => $roles) {
                Gate::define($title, function (User $user) use ($roles) {
                    return count(array_intersect($user->role->pluck('id')->toArray(), $roles));
                });
            }
        }*/

        //
    }
}
