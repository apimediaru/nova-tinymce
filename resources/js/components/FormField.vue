<template>
  <DefaultField
    :field="field"
    :errors="errors"
    :show-help-text="showHelpText"
    full-width-content
    class="nova-tinymce-hide-textarea"
  >
    <template #field>
      <RichTextEditor
        v-model="value"
        :init="editorConfig"
      />
    </template>
  </DefaultField>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova';
import hasEditor from '@/mixins/hasEditor';

export default {
  mixins: [FormField, HandlesValidationErrors, hasEditor],

  props: ['resourceName', 'resourceId', 'field'],

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

  },
};
</script>
