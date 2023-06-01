require('./bootstrap');

window.Vue = require('vue').default;

import ShortLinkComponent from "./components/ShortLinkComponent.vue";

const app = new Vue({
    el: '#app',
    components: {
        ShortLinkComponent
    }
});
