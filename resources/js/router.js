import Vue from 'vue';
import VueRouter from 'vue-router';
import LoginComponent from './components/auth/LoginComponent';
import DashboardComponent from './components/auth/DashboardComponent';
import NotFoundComponent from './components/NotFoundComponent';
import AddPostComponent from './components/auth/AddPostComponent';
import HomeComponent from './components/HomeComponent';
import FootballNewsComponent from './components/FootballNewsComponent';
import SinglePost from './components/posts/SinglePost';
import AdminComponent from './components/auth/AdminComponent';
import EditPostComponent from './components/auth/EditPostComponent'
import ManagePostsComponent from './components/auth/ManagePostsComponent'
import AddUserComponent from './components/auth/AddUserComponent'
import CategoriesComponent from './components/auth/CategoriesComponent'
import ManageUsersComponent from './components/auth/ManageUsersComponent'
import EditUserComponent from './components/auth/EditUserComponent'

import swal from 'sweetalert';

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
    {path: '/football-news', component: FootballNewsComponent, name: 'football-news'},
    {path: '/post/:slug', component: SinglePost, name: 'single-post'},
    {path: '/admin', component: AdminComponent, children: [
        {path: '', component: DashboardComponent, name: 'dashboard'},
        {path: 'add-post', component: AddPostComponent, name: 'add-post'},
        {path: 'edit-post/:id', component: EditPostComponent, name: 'edit-post'},
        {path: 'manage-posts', component: ManagePostsComponent, name: 'manage-posts'},
        {path: 'add-user', component: AddUserComponent, name: 'add-user'},
        {path: 'manage-users', component: ManageUsersComponent, name: 'manage-users'},
        {path: 'edit-user/:id', component: EditUserComponent, name: 'edit-user'},
        {path: 'manage-categories', component: CategoriesComponent, name: 'manage-categories'},
        {path: 'edit-category/:id', component: CategoriesComponent, name: 'edit-category'},


    ], beforeEnter: (to, from, next)=>{
        user.isLoggedIn(res=>{
            if(!res){
                swal({title: 'You must be logged in.', icon: 'error'});
                next('/login');
            }else{
                next();
            }
        })
    }},
    {path: '**', component: NotFoundComponent, name: 'page-not-found'}

]

const router = new VueRouter({
    mode: 'history',
    history: true,
    routes,
});


export default router;
