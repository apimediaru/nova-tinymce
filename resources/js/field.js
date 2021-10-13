Nova.booting((Vue, router, store) => {
  Vue.component('index-TinyMCE', require('./components/IndexField'))
  Vue.component('detail-TinyMCE', require('./components/DetailField'))
  Vue.component('form-TinyMCE', require('./components/FormField'))
})
