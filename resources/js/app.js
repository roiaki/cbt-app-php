/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */




 new Vue({
    el: '#app',
    data: {
        texts: [], // 複数入力のデータ（配列）,
        strength: [],
        maxTextCount: 3
    },
    methods: {
        // ボタンをクリックしたときのイベント ①〜③
        addInput() {

            if(this.isTextMax) {

                return;

            }

            this.texts.push(''); // 配列に１つ空データを追加する

            Vue.nextTick(() => {

                const maxIndex = this.texts.length - 1;
                console.log(maxIndex)
                this.$refs['texts'][maxIndex].focus(); // 追加された入力ボックスにフォーカスする

            });

        },
        removeInput(index) {

            this.texts.splice(index, 1);
            this.strength.splice(index, 1);

        },
        

        
    },
    computed: {
        isTextMax() {

            return (this.texts.length >= this.maxTextCount);

        },
        remainingTextCount() {

            return this.maxTextCount - this.texts.length; // 追加できる残り件数

        }
    }
});

 
  
