<template>
    <span>
        <span
                v-if="field.value"
        >
            <a
                    @click="open"
                    class="cursor-pointer dim inline-block text-primary font-bold text-sm transition-all"
                    aria-role="button"
            >
                {{ __('Show Content') }}
            </a>
        </span>
        <span v-else>&mdash;</span>
        <modal
                v-if="field.value && modalOpen"
                @modal-close="close"
        >
            <div
                    class="bg-40 rounded-lg shadow-lg overflow-hidden p-8 relative"
                    style="width: 100%; max-width: 1200px;"
            >
                <span
                        @click="close"
                        class="cursor-pointer"
                        style="position: absolute; right: 4px; top: 4px;"
                        :title="__('Close')"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 48 48" fill="#333333">
                        <path d="M38 12.83L35.17 10 24 21.17 12.83 10 10 12.83 21.17 24 10 35.17 12.83 38 24 26.83 35.17 38 38 35.17 26.83 24z"/>
                        <path d="M0 0h48v48H0z" fill="none"/>
                    </svg>
                </span>
                <div v-html="field.value" />
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
