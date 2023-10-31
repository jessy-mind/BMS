import Vue from 'vue'
import Router from 'vue-router'
import homepage from './components/pages/homepage.vue';

// Admin pages imported
import dashboard from './components/admin/dashboard';
import super_admin from './components/admin/superUser';
import profile from './components/admin/profile';
import stores from './components/admin/store';
import store_admins from './components/admin/storeAdmin';
import product from './components/admin/product';

Vue.use(Router)

const routes = [
    { path: '/home_page', component: homepage },

    { path: '/dashboard', component: dashboard },

    { path: '/manage_super_admin', component: super_admin },

    { path: '/manage_stores', component: stores },

    { path: '/manage_store_admins', component: store_admins },

    { path: '/manage_products', component: product },

    { path: '/profile', component: profile },
]

export default new Router({
    mode: 'history',
    routes 
})