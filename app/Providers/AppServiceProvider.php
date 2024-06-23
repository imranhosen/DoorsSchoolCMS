<?php

namespace App\Providers;

use App\Actions\ForceDeleteAction;
use App\Actions\ModalAction;
use App\Models\Voyager\menu\Menu;
use App\Models\Voyager\post\Post;
use Illuminate\Support\ServiceProvider;
use TCG\Voyager\Facades\Voyager;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Enable custom action for publish posts
        Voyager::addAction(\App\Actions\PublishAction::class);
        Voyager::addAction(\App\Actions\StatusAction::class);
        Voyager::addAction(\App\Actions\ApprovalAction::class);
        Voyager::addAction(ForceDeleteAction::class);
        Voyager::addAction(ModalAction::class);
        //Voyager::useModel('Menu', Menu::class);
        Voyager::useModel('Post', Post::class);


    }
}
