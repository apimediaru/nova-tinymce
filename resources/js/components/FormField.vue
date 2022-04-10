<template>
  <DefaultField
    :field="field"
    :errors="errors"
    :show-help-text="showHelpText"
    full-width-content
    class="nova-tinymce-hide-textarea"
  >
    <template #field>
      <TinymceEditor
        v-if="initialized"
        :id="id"
        v-model="value"
        :init="editorConfig"
      />
    </template>
  </DefaultField>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova';
import { uuid } from '../utils';
import hasEditor from '@/mixins/hasEditor';

export default {
  mixins: [FormField, HandlesValidationErrors, hasEditor],

  props: ['resourceName', 'resourceId', 'field'],

  data() {
    return {
      initialized: false,
      id: null,
    };
  },

  created() {
    this.id = `nova-tinymce-${uuid()}`;
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

    /**
     * Initialize TinyMCE editor.
     */
    initializeEditor() {
      this.$nextTick(() => {
        this.initialized = true;
      });
    },
  },
};
</script>
