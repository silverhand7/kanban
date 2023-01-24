import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            component: () => import('./pages/Home.vue'),
            children: [
                {
                    path: ':id',
                    component: () => import('./pages/Card.vue'),
                    props: true
                }
            ]
        },
    ],
});

export default router;