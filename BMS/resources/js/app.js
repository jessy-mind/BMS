require('./bootstrap');

window.Vue = require('vue');
import router from './router'
import store from './store'
import common from './common'
import iView from 'iview';
import 'iview/dist/styles/iview.css';
import locale from 'iview/dist/locale/en-US';

Vue.mixin(common)
Vue.use(iView, { locale });
Vue.component('mainapps', require('./components/mainapps.vue').default);

const app = new Vue ({
    el: '#app',
    router, store
})