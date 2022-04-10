<template>
  <span>
    <span
      v-if="field.value"
    >
      <a
        class="inline-block py-1 text-primary-500 hover:text-red-600 font-bold no-underline"
        aria-role="button"
        @click.stop.prevent="open"
      >
        {{ __('novaTinyMCE.showContent') }}
      </a>
    </span>
    <span v-else>&mdash;</span>
    <modal
      v-if="field.value"
      :show="modalOpen"
      :max-width="false"
      @close-via-escape="close"
    >
      <div
        class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden mx-auto nova-tinymce-hide-textarea"
        style="max-width: 1200px;"
      >
        <ModalHeader class="flex items-center">
          {{ field.name }}
        </ModalHeader>
        <ModalContent>
          <TinymceEditor
            v-model="field.value"
            :init="editorConfig"
            disabled
          />
        </ModalContent>
        <ModalFooter>
          <div class="ml-auto">
            <LoadingButton
              ref="confirmButton"
              @click.prevent="close"
            >
              {{ __('Close') }}
            </LoadingButton>
          </div>
        </ModalFooter>
      </div>
    </modal>
  </span>
</template>

<script>
import hasEditor from '@/mixins/hasEditor';

export default {
  mixins: [hasEditor],

  props: ['resourceName', 'field'],

  data: () => ({
    modalOpen: false,
  }),

  computed: {
    editorConfig() {
      return {
        ...this.getEditorBaseOptions(),
        height: window.innerHeight - 200,
      };
    },
  },

  methods: {
    /**
     * Show modal.
     */
    open() {
      this.modalOpen = true;
    },

    /**
     * Hide modal.
     */
    close() {
      this.modalOpen = false;
    },
  },
};
</script>
