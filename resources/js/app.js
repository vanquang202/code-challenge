
import App from './components/App.vue';
import VueRouter from "vue-router";
import axios from "axios";
import VueAxios from 'vue-axios';
import VueSocialauth from "vue-social-auth";
import VueX from "vuex";
import { store } from "./store";

require('./bootstrap');

window.Vue = require('vue').default;
Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(VueSocialauth, {
    providers: {
        google: {
            clientId:
                "492481953658-iob89kmo8rb87hb8th7q7ciassb21jbj.apps.googleusercontent.com",
            client_secret: "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",
            redirectUri: "https://api.laravel.org/api/callback",
        },
    },
});

import { routers } from "./routes";
const route = new VueRouter({
    linkExactActiveClass: "link-router-active",
    mode: "history",
    routes: routers,
});

const app = new Vue({
    el: "#app",
    router: route,
    store: store,
    // render: (h) => h(App),
});
