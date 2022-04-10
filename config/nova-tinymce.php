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
     * TinyMCE default height.
     * Can be number or string with css dimension.
     */
    'editor_height' => 500,

    /**
     * TinyMCE min height.
     * Must be an integer.
     */
    'editor_min_height' => 300,

    /**
     * TinyMCE skin.
     * Empty value means that skin will be auto-detected between oxide and oxide-dark variants.
     *
     * You can find available options here and lock a preferred skin.
     * @link https://www.tiny.cloud/docs/tinymce/6/customize-ui/#skins
     */
    'editor_skin' => null,

    /**
     * TinyMCE frontend language.
     * Can be plain string or string that refers to callable static class method.
     */
    'locale' => 'App::getLocale',

];
