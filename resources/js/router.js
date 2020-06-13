import Vue from 'vue';
import VueRouter from 'vue-router';
import LoginComponent from './components/auth/LoginComponent';
import DashboardComponent from './components/auth/DashboardComponent';
import NotFoundComponent from './components/NotFoundComponent';
import AddPostComponent from './components/AddPostComponent';
import HomeComponent from './components/HomeComponent';
import SinglePost from './components/posts/SinglePost';

Vue.use(VueRouter);



const routes = [
    {path: '/', component: HomeComponent},
    {path: '/login', component: LoginComponent},
    {path: '/post/:id', component: SinglePost},
    {path: '/dashboard', component: DashboardComponent},
    {path: '/add-post', component: AddPostComponent},
    {path: '**', component: NotFoundComponent}

]


const router = new VueRouter({
    mode: 'history',
    history: true,
    routes,
});


export default router;
