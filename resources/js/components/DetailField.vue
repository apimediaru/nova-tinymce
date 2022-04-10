<template>
  <panel-item
    :field="field"
    class="nova-tinymce-hide-textarea"
  >
    <template
      #value
    >
      <TinymceEditor
        v-model="field.value"
        :init="editorConfig"
        disabled
      />
    </template>
  </panel-item>
</template>

<script>
import hasEditor from '@/mixins/hasEditor';

export default {
  mixins: [hasEditor],

  props: ['resource', 'resourceName', 'resourceId', 'field'],
};
</script>
