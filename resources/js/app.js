require('./bootstrap');
import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from '../views/App'
import task from '../views/task'
import Home from '../views/Home'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/task/:id',
            name: 'task',
            props: true,
            component: task,
        },
    ]
})

const app = new Vue({
    el: '#app' ,
    components: { App },
    router,
})
