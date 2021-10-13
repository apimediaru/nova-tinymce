<?php

namespace APIMedia\TinyMCE\Http\Services;

class EditorConfig
{
    public static function get()
    {
        $config = config('nova-tinymce.editor_config');
        if (is_callable($config)) { return call_user_func($config); }
        if (is_array($config)) { return $config; }
        return [];
    }

    public static function generate()
    {
        return [
            'menubar' => true,
            'branding' => false,
            'style_formats_merge' => true,
            'plugins' => [
                'lists advlist autolink charmap print preview',
                'link anchor image imagetools emoticons hr paste',
                'searchreplace visualblocks code fullscreen insertdatetime',
                'media table paste code help wordcount',
            ],
            'toolbar' => [
                'undo redo paste pastetext | searchreplace | formatselect | bold italic backcolor | link anchor image | ' .
                'alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | ' .
                'removeformat hr | styleselect | emoticons | help',
            ],
            'formats' => [
                'nowrap' => [
                    'inline' => 'span',
                    'classes' => 'text-nowrap',
                ],
            ],
            'style_formats' => [
                [
                    'title' => __('nova-tinymce::editor.utilities'),
                    'items' => [
                        [
                            'title' => __('nova-tinymce::editor.text_nowrap'),
                            'format' => 'nowrap',
                        ],
                    ],
                ],
            ],
            'image_class_list' => [
                [
                    'title' => __('nova-tinymce::editor.none'),
                    'value' => '',
                ],
                [
                    'title' => __('nova-tinymce::editor.image_responsive'),
                    'value' => 'rte-image-responsive',
                ],
                [
                    'title' => __('nova-tinymce::editor.full_width'),
                    'value' => 'rte-full-width',
                ],
            ],
            'link_context_toolbar' => false,
        ];
    }
}
