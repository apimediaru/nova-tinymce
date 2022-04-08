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
        {{ __('Show Content') }}
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
        class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden mx-auto"
        style="max-width: 1200px;"
      >
        <ModalHeader class="flex items-center">
          {{ field.name }}
        </ModalHeader>
        <ModalContent v-html="field.value" />
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
export default {
  props: ['resourceName', 'field'],

  data: () => ({
    modalOpen: false,
  }),

  created() {
    console.log(this.field);
  },

  methods: {
    open() {
      this.modalOpen = true;
    },
    close() {
      this.modalOpen = false;
    },
  },
};
</script>
