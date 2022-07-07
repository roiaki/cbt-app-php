VueCreateApp({})
  .componet('my-hello', {
    template: '<div>こんにちは, {{ name }} </div>',
    data() {
      return {
        anme: 'Vue'
      };
    }
  })
.mount('#app');