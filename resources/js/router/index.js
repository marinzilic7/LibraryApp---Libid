import { createRouter, createWebHistory } from 'vue-router'
import Prijava from '../views/Prijava.vue'
import Registracija from '../views/Registracija.vue'
import Pocetna from '../views/Pocetna.vue'
import Knjiga from '../views/Knjiga.vue'
import Admin from '../views/Admin.vue'
import Kosarica from '../views/Kosarica.vue'
import Kontakt from '../views/Kontakt.vue'



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
            path:'/books',
            name:'books',
            component: Knjiga
        },
        {
            path:'/admin',
            name:'admin',
            component: Admin
        },
        {
            path:'/contact',
            name:'contact',
            component: Kontakt
        },
        {
            path:'/cart',
            name:'cart',
            component: Kosarica
        },



    ]
})


export default router
