<?php

namespace APIMedia\TinyMCE;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;
use APIMedia\TinyMCE\Http\Services\EditorConfig;

class FieldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::serving(function (ServingNova $event) {
            Nova::script('TinyMCE', __DIR__.'/../dist/js/field.js');
            Nova::style('TinyMCE', __DIR__.'/../dist/css/field.css');
            Nova::provideToScript([
                'novaTinyMCE' => [
                    'api_key' => config('nova-tinymce.api_key'),
                    'editorConfig' => EditorConfig::get(),
                    'locale' => $this->getLocale(),
                ],
            ]);
        });

        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'nova-tinymce');

        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/nova-tinymce'),
        ], 'nova-tinymce-lang');

        $this->publishes([
            __DIR__.'/../config/nova-tinymce.php' => config_path('nova-tinymce.php')
        ], 'nova-tinymce-config');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/nova-tinymce.php', 'nova-tinymce'
        );
    }

    public function getLocale()
    {
        $locale = config('nova-tinymce.locale', \App::getLocale());

        if (is_callable($locale)) {
            $locale = call_user_func($locale);
        }

        return $locale;
    }
}
