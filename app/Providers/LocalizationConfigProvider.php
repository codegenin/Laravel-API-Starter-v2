<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class LocalizationConfigProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        config([
            'laravellocalization.supportedLocales' => [
                'en' => array('name'   => 'English',
                              'sript'  => 'Latn',
                              'native' => 'English'
                ),
                'fr' => ['name'     => 'French',
                         'script'   => 'Latn',
                         'native'   => 'Français',
                         'regional' => 'fr_FR'
                ],
            ],
            
            'laravellocalization.useAcceptLanguageHeader' => true,
            
            'laravellocalization.hideDefaultLocaleInURL' => true
        ]);
    }
}
