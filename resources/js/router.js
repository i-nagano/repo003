import Vue from 'vue';
import Router from 'vue-router';
import Home from './components/routerviews/Home.vue';
import Members from './components/routerviews/Members.vue';
import Cars from './components/routerviews/Cars.vue';
import Example from './components/routerviews/ExampleComponent.vue';

Vue.use(Router);

export default new Router({
    mode: 'history',
    routes: [
        {
            name: 'Home',
            path: '/',
            component: Home
        },
        {
            name: 'Members',
            path: '/members',
            component: Members
        },
        {
            name: 'Cars',
            path: '/cars',
            component: Cars
        },
        {
            name: 'Example',
            path: '/example',
            component: Example
        },
    ],
});

