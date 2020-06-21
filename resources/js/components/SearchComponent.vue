<template>
    <div>
        <header-component></header-component>
        <div class="text-center mt-2">
            <v-divider></v-divider>
            <h2>Search results for: {{$route.query.q}}</h2>
            <v-divider></v-divider>
        </div>
        <v-skeleton-loader v-if="!posts.length" v-show="skeleton" v-for="n in 3" :key="n" type="card, list-item" :loading="loading"></v-skeleton-loader>
        <v-container v-if="posts.length">
            <v-row>
                <v-col cols="12" xs="12" sm="12" lg="8">
                    <post-card v-for="post in posts" :key="post.id" :post="post">
                    </post-card>
                    <div class="text-center">
                        <v-divider></v-divider>
                        <v-pagination v-model="page" :length="totalPages">
                        </v-pagination>
                    </div>
                </v-col>                
            </v-row>
        </v-container>
        <v-container v-else>
            <h4>No Search Result</h4>
        </v-container>

    </div>
    </div>
</template>

<script>
import HeaderComponent from './HeaderComponent'
import PostCard from './posts/PostCard';
import axios from 'axios'
export default{
    components: {HeaderComponent, 'post-card': PostCard},
    mounted(){
        this.getSearch();
    },    
    data(){
        return {
            page: 1,
            skeleton: true,
            loading: true,
            posts: [],
            totalPages: 0,
            
        }
    },
    watch: {
        page: {
            handler(){
                this.getSearch();
            }
        },
        $route: {
            handler(to, from){
                this.getSearch(); 
            }
        }
    },
    metaInfo(){
        return{
            title: "Search results from "+this.$route.query.q,
        }
    },
    methods: {
        getSearch(){
            this.posts=[];
            axios.post('/search?page='+this.page, {search: this.$route.query.q}).then(res=>{                
                 if(res.data.data){
                    this.posts = res.data.data;                    
                    this.totalPages = res.data.meta.last_page;
                }
                this.skeleton = false;                
            }).catch(err=>{
                console.log(err.response);
            })
        }
    }
}
</script>

<style>

</style>