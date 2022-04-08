<template>
  <DefaultField
    :field="field"
    :errors="errors"
    :show-help-text="showHelpText"
    full-width-content
  >
    <template #field>
      <editor
        v-if="initialized"
        :id="id"
        v-model="value"
        :api-key="apiKey"
        :init="editorConfig"
        init-delay
      />
    </template>
  </DefaultField>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova';
import Editor from '@tinymce/tinymce-vue';
import { uuid } from '../utils';

const EDITOR_FALLBACK_HEIGHT = 500;

export default {

  components: {
    editor: Editor,
  },

  mixins: [FormField, HandlesValidationErrors],

  props: ['resourceName', 'resourceId', 'field'],

  data() {
    return {
      initialized: false,
    };
  },

  computed: {
    id() {
      return this.id;
    },

    /**
     * Get Nova TinyMCE config
     * @return {Object}
     */
    config() {
      return window.Nova.appConfig.NovaTinyMCE;
    },

    /**
     * TinyMCE API Key
     * @return {string}
     */
    apiKey() {
      this.config.api_key;
    },

    /**
     * Current locale
     * @return {string}
     */
    language() {
      return this.config.locale;
    },

    /**
     * TinyMCE field height
     * @return {boolean|*}
     */

    /**
     * TinyMCE configuration parameters
     * @return {Object}
     */
    editorConfigOptions() {
      const { editorConfig: fieldEditorConfig } = this.field;
      if (fieldEditorConfig && Object.keys(fieldEditorConfig).length) {
        return fieldEditorConfig;
      }
      const { editorConfig: packageEditorConfig } = this.config;
      if (packageEditorConfig && Object.keys(packageEditorConfig).length) {
        return packageEditorConfig;
      }
      return {};
    },

    /**
     * TinyMCE entire options
     * @return {Object}
     */
    editorConfig() {
      const config = this.editorConfigOptions;
      const height = this.getEditorHeight();
      return {
        ...config,
        language: this.language,
        height,
      };
    },
  },

  created() {
    this.id = `tinymce_editor_${uuid()}`;
  },

  mounted() {
    this.initializeEditor();
  },

  methods: {
    /*
     * Set the initial, internal value for the field.
     */
    setInitialValue() {
      this.value = this.field.value || '';
    },

    /**
     * Fill the given FormData object with the field's internal value.
     */
    fill(formData) {
      formData.append(this.field.attribute, this.value || '');
    },

    getEditorHeight() {
      return this.field.height || this.editorConfigOptions.height || this.config.editorHeight || EDITOR_FALLBACK_HEIGHT;
    },

    /**
     * Initialize TinyMCE editor
     */
    initializeEditor() {
      this.$nextTick(() => {
        this.initialized = true;
      });
    },
  },
};
</script>
