import Editor from '@tinymce/tinymce-vue';

const EDITOR_FALLBACK_HEIGHT = 500;

export default {
  components: {
    TinymceEditor: Editor,
  },

  computed: {
    /**
     * Get Nova TinyMCE config
     * @return {Object}
     */
    config() {
      return window.Nova.appConfig.NovaTinyMCE;
    },

    /**
     * Current locale
     * @return {string}
     */
    language() {
      return this.config.locale;
    },

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
      return this.getEditorBaseOptions();
    },
  },

  methods: {
    /**
     * Get Nova predefined theme name.
     * @return {undefined|string}
     */
    getNovaTheme() {
      return localStorage.novaTheme;
    },

    /**
     * Get editor skin related options.
     * @return {Object}
     */
    getSkin() {
      const options = {
        skin: (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'oxide-dark' : 'oxide'),
        content_css: (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'default'),
      };

      const option = this.config.editorSkin;
      if (option) {
        options.skin = option;
        options.content_css = option.includes('dark') ? 'dark' : 'default';
      }

      const theme = localStorage.novaTheme;
      if (theme) {
        options.skin = theme === 'dark' ? 'oxide-dark' : 'oxide';
        options.content_css = theme === 'dark' ? 'dark' : 'default';
      }

      return options;
    },

    /**
     * Get editor display height.
     * @return {string|number}
     */
    getEditorHeight() {
      return this.field.height || this.editorConfigOptions.height || this.config.editorHeight;
    },

    /**
     * Editor base configuration options
     * @return {Object}
     */
    getEditorBaseOptions() {
      return {
        ...this.editorConfigOptions,
        ...this.getSkin(),
        language: this.language,
        height: this.getEditorHeight(),
        min_height: this.getEditorFallbackHeight(),
        base_url: '/vendor/nova-tinymce',
        branding: false,
      };
    },

    /**
     * Get editor fallback height
     * @return {number}
     */
    getEditorFallbackHeight() {
      return this.config.editorMinHeight || EDITOR_FALLBACK_HEIGHT;
    },
  },
};
