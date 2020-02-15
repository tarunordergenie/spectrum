import Vue from 'vue'
import VueRouter from 'vue-router';
import LoginComponent from './components/LoginComponent';
import DashboardComponent from './components/DashboardComponent';
import HomeComponent from './components/HomeComponent';
import AdminComponent from './components/AdminComponent';
import PatientassesmentComponent from './components/PatientassesmentComponent';
import UserComponent from './components/UserComponent';
import ProfileComponent from './components/ProfileComponent';
import PrivacyComponent from './components/PrivacyComponent';
import PrivacyfrComponent from './components/PrivacyfrComponent';
Vue.use(VueRouter)
const routes = [
    {
        path:'/',
        component:LoginComponent,
    },
    {
        path:'/login',
        component:LoginComponent,
        name:'login',
    },
    {
        path:'/privacy',
        component:PrivacyComponent,
        name:'PrivacyComponent'
    },
    {
        path:'/privacyfr',
        component:PrivacyfrComponent,
        name:'PrivacyfrComponent'
    },
    {
        path:'/dashboard',
        component:DashboardComponent,
        name:'dashboard',
        children: [
            {
              // UserPosts will be rendered inside User's <router-view>
              // when /user/:id/posts is matched
              path: '/',
              component: HomeComponent
            },
            {
                path: 'admin',//users
                component: AdminComponent
            },
            {
                path: 'users',//
                component: UserComponent
            },
            {
            path: 'patientassesment',
            component: PatientassesmentComponent
            },
            {
                path:'profile',
                component:ProfileComponent
            },
          ],
        beforeEnter: (to, from, next) => {
            if(localStorage.getItem('token')){
                next();
            }else{
                next('/login');
            }
        
        }
    },
];

const router =  new  VueRouter({routes})
router.beforeEach((to,form,next)=>{
    const token=localStorage.getItem('token') || null;
    window.axios.defaults.headers.common['Authorization'] = 'Bearer '+token;
    next();
})

export default router
