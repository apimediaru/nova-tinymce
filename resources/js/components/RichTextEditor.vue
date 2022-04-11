<template>
  <Editor
    v-if="initialized"
    v-bind="$attrs"
    :id="id"
  />
</template>

<script>
import Editor from '@tinymce/tinymce-vue';
import { uuid } from '../utils';

export default {
  name: 'RichTextEditor',

  components: { Editor },

  inheritAttrs: false,

  data: () => ({
    initialized: false,
    id: null,
  }),

  created() {
    this.id = `nova-tinymce-${uuid()}`;
  },

  mounted() {
    this.initializeEditor();
  },

  methods: {
    /**
     * Initialize TinyMCE editor with a small delay to fix usage
     * in nova-tabs and other nova components.
     */
    initializeEditor() {
      this.$nextTick(() => {
        this.initialized = true;
      });
    },
  },
};
</script>

<style scoped>

</style>
