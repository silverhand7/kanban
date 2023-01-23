// import { createRouter, createWebHistory } from 'vue-router';

// const router = createRouter({
//     history: createWebHistory(),
//     routes: [
//         {
//             path: '/',
//             component: () => import('./pages/Home.vue')
//         },
//         {
//             path: '/test',
//             component: () => import('./pages/Test.vue')
//         },
//     ],
// });

import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            component: () => import('./pages/Home.vue')
        },
        {
            path: '/test',
            component: () => import('./pages/Test.vue')
        },
    ],
});

export default router;