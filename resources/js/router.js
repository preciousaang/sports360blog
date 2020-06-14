import Vue from 'vue';
import VueRouter from 'vue-router';
import LoginComponent from './components/auth/LoginComponent';
import DashboardComponent from './components/auth/DashboardComponent';
import NotFoundComponent from './components/NotFoundComponent';
import AddPostComponent from './components/auth/AddPostComponent';
import HomeComponent from './components/HomeComponent';
import SinglePost from './components/posts/SinglePost';
import AdminComponent from './components/auth/AdminComponent';
import EditPostComponent from './components/auth/EditPostComponent'

Vue.use(VueRouter);

import user from './mixins/user';



const routes = [
    {path: '/', component: HomeComponent, name: 'homepage'},
    {path: '/login', component: LoginComponent, name: 'login', beforeEnter: (to, from , next)=>{
        user.isLoggedIn(res=>{
            if(res){
                next('/admin');
            }else{
                next();
            }
        });
    }},
    {path: '/post/:id', component: SinglePost, name: 'single-post'},
    {path: '/admin', component: AdminComponent, children: [
        {path: '', component: DashboardComponent, name: 'dashboard'},
        {path: 'add-post', component: AddPostComponent, name: 'add-post'},
        {path: 'edit-post/:id', component: EditPostComponent, name: 'edit-post'},

    ], beforeEnter: (to, from, next)=>{
        user.isLoggedIn(res=>{
            if(!res){
                next('/login');
            }else{
                next();
            }
        })
    }},
    {path: '**', component: NotFoundComponent}

]



const router = new VueRouter({
    mode: 'history',
    history: true,
    routes,
});




export default router;
