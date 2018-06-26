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
            $event->menu->add(trans('menu.main.navigation'));
            $event->menu->add([
                'text' => trans('category.label.categories'),
                'url'  => LaravelLocalization::setLocale() . '/admin/categories',
                'icon' => 'file',
            ]);
            $event->menu->add([
                'text' => trans('collection.label.collections'),
                'url'  => LaravelLocalization::setLocale() . '/admin/collections',
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
