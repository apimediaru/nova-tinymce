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
                'NovaTinyMCE' => [
                    'editorConfig' => EditorConfig::get(),
                    'editorHeight' => config('nova-tinymce.editor_height'),
                    'editorMinHeight' => config('nova-tinymce.editor_min_height'),
                    'editorSkin' => config('nova-tinymce.editor_skin'),
                    'locale' => $this->getEditorLocale(),
                ],
            ]);
        });

        // Load translations to nova
        $this->registerTranslations();

        // Publish public assets
        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/nova-tinymce'),
        ], 'nova-tinymce-assets');

        // Publish localizations
        $this->publishes([
            __DIR__.'/../resources/lang' => lang_path('vendor/nova-tinymce')
        ], 'nova-tinymce-lang');

        // Publish config
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

        $this->commands([
            Console\PublishCommand::class,
        ]);
    }

    /**
     * Get locale for TinyMCE
     *
     * @return string
     */
    public function getEditorLocale()
    {
        $locale = config('nova-tinymce.locale', \App::getLocale());

        if (is_callable($locale)) {
            $locale = call_user_func($locale);
        }

        return $locale;
    }

    /**
     * Register translations for current locale
     *
     * @return void
     */
    protected function registerTranslations()
    {
        $currentLocale = app()->getLocale();

        Nova::translations(__DIR__.'/../resources/lang/'.$currentLocale.'.json');
        Nova::translations(lang_path('vendor/nova-tinymce/'.$currentLocale.'.json'));

        $this->loadTranslationsFrom(__DIR__.'/../resources/lang/', 'nova-tinymce');
        $this->loadJsonTranslationsFrom(__DIR__.'/../resources/lang');
        $this->loadJsonTranslationsFrom(lang_path('vendor/nova-tinymce/'.$currentLocale.'.json'));
    }
}
