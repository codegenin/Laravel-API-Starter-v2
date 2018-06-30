<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AdminMenuServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @param Dispatcher $events
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $event->menu->add(trans('label.main_navigation'));
            $event->menu->add([
                'text' => trans('label.categories'),
                'url'  => LaravelLocalization::setLocale() . '/admin/categories',
                'icon' => 'file',
            ]);
            $event->menu->add([
                'text' => trans('label.tags'),
                'url'  => LaravelLocalization::setLocale() . '/admin/tags',
                'icon' => 'file',
            ]);
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
