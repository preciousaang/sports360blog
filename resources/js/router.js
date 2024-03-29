import Vue from 'vue';
import VueRouter from 'vue-router';
import LoginComponent from './components/auth/LoginComponent';
import DashboardComponent from './components/auth/DashboardComponent';
import NotFoundComponent from './components/NotFoundComponent';
import AddPostComponent from './components/auth/AddPostComponent';
import HomeComponent from './components/HomeComponent';
import CategoryPostList from './components/CategoryPostList';
import SinglePost from './components/posts/SinglePost';
import AdminComponent from './components/auth/AdminComponent';
import EditPostComponent from './components/auth/EditPostComponent'
import ManagePostsComponent from './components/auth/ManagePostsComponent'
import AddUserComponent from './components/auth/AddUserComponent'
import CategoriesComponent from './components/auth/CategoriesComponent'
import ManageUsersComponent from './components/auth/ManageUsersComponent'
import EditUserComponent from './components/auth/EditUserComponent'
import ProfileComponent from './components/auth/ProfileComponent'
import AboutUsComponent from './components/AboutUsComponent'
import PremierLeague from './components/PremierLeague'
import Bundesliga from './components/Bundesliga'
import SerieA from './components/SerieA'
import LaLiga from './components/LaLiga'
import LeagueOne from './components/LeagueOne'
import FileUploader from './components/auth/FileUploader';
import SearchComponent from './components/SearchComponent';
import UnsubscribeComponent from './components/UnsubscribeComponent'
import SubscribersListComponent from './components/auth/SubscribersListComponent'

import swal from 'sweetalert';

Vue.use(VueRouter);

import user from './mixins/user';



const routes = [
    {path: '/', component: HomeComponent, name: 'homepage'},
    {path: '/about-us', component: AboutUsComponent, name: 'about-us'},
    {path: '/search', component: SearchComponent, name: 'search'},
    {path: '/login', component: LoginComponent, name: 'login', beforeEnter: (to, from , next)=>{
        user.isLoggedIn(res=>{
            if(res){                
                next('/admin');
            }else{                
                next();
            }
        });
    }},
    {path: '/football-news', component: CategoryPostList, name: 'football-news'},
    {path: '/sports-lifestyle', component: CategoryPostList, name: 'sports-lifestyle'},
    {path: '/match-previews', component: CategoryPostList, name: 'match-previews'},    
    {path: '/premier-league-table', component: PremierLeague, name: 'premier-league'},
    {path: '/bundesliga-table', component: Bundesliga, name: 'bundesliga'},
    {path: '/serie-a-table', component: SerieA, name: 'serie-a'},
    {path: '/la-liga-table', component: LaLiga, name: 'la-liga'},
    {path: '/league-1-table', component: LeagueOne, name: 'league-1'},
    {path: '/post/:slug', component: SinglePost, name: 'single-post'},
    {path: '/unsubscribe-successful', component: UnsubscribeComponent, name: 'unsubscribe-successful'},
    {path: '/admin', component: AdminComponent, children: [
        {path: '', component: DashboardComponent, name: 'dashboard'},
        {path: 'add-post', component: AddPostComponent, name: 'add-post'},
        {path: 'upload-file', component: FileUploader},
        {path: 'edit-post/:id', component: EditPostComponent, name: 'edit-post'},
        {path: 'manage-posts', component: ManagePostsComponent, name: 'manage-posts'},
        {path: 'add-user', component: AddUserComponent, name: 'add-user'},
        {path: 'manage-users', component: ManageUsersComponent, name: 'manage-users'},
        {path: 'edit-user/:id', component: EditUserComponent, name: 'edit-user'},
        {path: 'subscribers', component: SubscribersListComponent, name: 'subscribers'},
        {path: 'manage-categories', component: CategoriesComponent, name: 'manage-categories'},
        {path: 'edit-category/:id', component: CategoriesComponent, name: 'edit-category'},
        {path: 'profile', component: ProfileComponent, name: 'profile'},


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
