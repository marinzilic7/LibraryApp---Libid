import { createRouter, createWebHistory } from 'vue-router'
import Prijava from '../views/Prijava.vue'
import Registracija from '../views/Registracija.vue'
import Pocetna from '../views/Pocetna.vue'
import Admin from '../views/Admin.vue'


const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'login',
            component: Prijava
        },

        {
            path:'/register',
            name: 'register',
            component: Registracija
        },
        {
            path: '/home',
            name: 'home',
            component: Pocetna
        },
        {
            path: '/admin',
            name: 'admin',
            component: Admin
        },
    ]
})


export default router
