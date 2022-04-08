<?php

namespace APIMedia\TinyMCE;

use Laravel\Nova\Fields\Field;

class TinyMCE extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'tinymce-field';

    /**
     * Editor height
     *
     * @var int|string
     *
     */
    public $height = null;

    /**
     * Override editor config
     *
     * @param array $config
     * @return $this
     */
    public function editorConfig(array $config)
    {
        return $this->withMeta(['editorConfig' => $config]);
    }

    /**
     * Set field height
     *
     * @param int|string $value (css dimensions or number of px)
     * @return $this
     */
    public function height($value)
    {
        $this->height = $value;

        return $this;
    }

    /**
     * Get additional meta information to merge with the element payload.
     *
     * @return array
     */
    public function meta()
    {
        return array_merge($this->meta, [
            'height' => $this->height,
        ]);
    }
}
