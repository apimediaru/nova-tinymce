<?php

namespace APIMedia\TinyMCE\Http\Services;

class EditorConfig
{
    /**
     * Get TinyMCE configuration
     *
     * @return array
     */
    public static function get(): array
    {
        $config = config('nova-tinymce.editor_config');
        if (is_callable($config)) { return call_user_func($config); }
        if (is_array($config)) { return $config; }
        return [];
    }

    /**
     * Generate default TinyMCE configuration
     *
     * @return array
     */
    public static function generate(): array
    {
        return [
            'menubar' => 'file edit view insert format tools table help',
            'style_formats_merge' => true,
            'toolbar' => [
                'undo redo paste pastetext | searchreplace | formatselect | bold italic backcolor | link anchor image | ' .
                'alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | ' .
                'removeformat hr | styleselect | emoticons',
            ],
            'plugins' => 'lists advlist autolink charmap preview link anchor image emoticons searchreplace visualblocks code fullscreen insertdatetime media table code help wordcount',
            'formats' => [
                'nowrap' => [
                    'inline' => 'span',
                    'classes' => 'text-nowrap',
                ],
            ],
            'style_formats' => [
                [
                    'title' => __('novaTinyMCE.utilities'),
                    'items' => [
                        [
                            'title' => __('novaTinyMCE.textNowrap'),
                            'format' => 'nowrap',
                        ],
                    ],
                ],
            ],
            'image_class_list' => [
                [
                    'title' => __('novaTinyMCE.none'),
                    'value' => '',
                ],
                [
                    'title' => __('novaTinyMCE.imageResponsive'),
                    'value' => 'rte-image-responsive',
                ],
                [
                    'title' => __('novaTinyMCE.fullWidth'),
                    'value' => 'rte-full-width',
                ],
            ],
            'link_context_toolbar' => false,
        ];
    }
}
