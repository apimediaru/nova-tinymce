<?php

return [

    /**
     * Default editor config.
     * Should be an array or a string to class static method that returns an array.
     *
     * Check all available options here:
     * @link https://www.tiny.cloud/docs/
     */
    'editor_config' => 'APIMedia\TinyMCE\Http\Services\EditorConfig::generate',

    /**
     * TinyMCE API Key for your domain.
     *
     * You can create your own key here:
     * @link https://www.tiny.cloud/docs/quick-start/
     */
    'api_key' => 'fwm5m1tmeavfpclh5f3ueq3k77fjf7hmidopuk9romfsvuhv',

    /**
     * TinyMCE frontend language.
     * Can be plain string or string that refers to callable static class method.
     */
    'locale' => 'App::getLocale',

];
