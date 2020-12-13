import { App, plugin } from '@inertiajs/inertia-vue'
import Vue from 'vue'
import { InertiaProgress } from '@inertiajs/progress'
import Toasted from 'vue-toasted';
Vue.use(Toasted)

import axios from 'axios'

InertiaProgress.init()
Vue.mixin({
    methods : {
        toaster(message, status){
            Vue.toasted.show(message, {
                type : status,
            }).goAway(4000)
        }
    }
});
Vue.use(plugin)

const el = document.getElementById('app')
Vue.component('pagination', require('laravel-vue-pagination'));

new Vue({
  render: h => h(App, {
    props: {
      initialPage: JSON.parse(el.dataset.page),
      resolveComponent: name => require(`./Pages/${name}`).default,
    },
  }),
}).$mount(el)