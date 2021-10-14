<template>
  <default-field
    :field="field"
    :errors="errors"
    :show-help-text="showHelpText"
    full-width-content
  >
    <template slot="field">
      <editor
        :id="id"
        v-model="value"
        :api-key="apiKey"
        :init="editorConfig"
        initDelay
      />
    </template>
  </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova';
import Editor from '@apimediaru/nova-tinymce-vue';
import { getUID } from '../utils';

export default {
  mixins: [FormField, HandlesValidationErrors],

  props: ['resourceName', 'resourceId', 'field'],

  components: {
    'editor': Editor,
  },

  created() {
    this.id = `tinymce_editor_${getUID()}`;
  },

  computed: {
    apiKey() {
      return Nova.config.novaTinyMCE.api_key;
    },
    language() {
      return Nova.config.novaTinyMCE.locale;
    },
    height() {
      const { height } = this.field;
      if (!height) { return false; }
      return height;
    },
    editorConfigOptions() {
      const { editorConfig: fieldEditorConfig } = this.field;
      if (fieldEditorConfig && Object.keys(fieldEditorConfig).length) {
        return fieldEditorConfig;
      }
      const { editorConfig: packageEditorConfig } = Nova.config.novaTinyMCE;
      if (packageEditorConfig && Object.keys(packageEditorConfig).length) {
        return packageEditorConfig;
      }
      return {};
    },
    editorConfig() {
      const config = this.editorConfigOptions;
      const height = this.height || config.height || 500;
      return {
        ...config,
        language: this.language,
        height,
      };
    },
  },

  methods: {
    /*
     * Set the initial, internal value for the field.
     */
    setInitialValue() {
      this.value = this.field.value || ''
    },

    /**
     * Fill the given FormData object with the field's internal value.
     */
    fill(formData) {
      formData.append(this.field.attribute, this.value || '')
    },
  },
}
</script>
