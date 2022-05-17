import Vue from 'vue';
import Auth from './Auth.js';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

import Login from './components/Login.vue';
import Products from './components/Products.vue';

const routes = [
    {
        path: '/',
        component: Login,
        name: "Login"
    },
    {
        path: '/products',
        component: Products,
        name: "Products",
        meta: {
            requiresAuth: true
        }
    }
];

 const router = new VueRouter({
     mode: 'history',
     routes: routes
 });

router.beforeEach((to, from, next) => {
    //if (to.matched.some(record => record.meta.requiresAuth) ) {
    if (to.meta.requiresAuth && !Auth.check()) {
        router.push('/');
        router.go();
    } else {
        next();
    }
});

export default router;