<template>
    <div>
        <header-component></header-component>
        <div class="text-center mt-2">
            <h2>{{title}}</h2>
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
                <v-col cols="12" xs="12" sm="12" lg="4">
                    <h3>Popular Posts</h3>
                    <ul>
                        
                    </ul>
                </v-col>
            </v-row>
        </v-container>
        <v-container v-else>
            <h4>No Posts in this category</h4>
        </v-container>

    </div>
</template>

<script>
import HeaderComponent from './HeaderComponent';
import PostCard from './posts/PostCard';
import axios from 'axios'
export default {
    data(){
        return {
            page: 1,
            skeleton: true,
            title: null,
            loading: true,
            posts: [],
            totalPages: 0,
        }
    },
    components: {
        'header-component': HeaderComponent,
        'post-card': PostCard
    },
    methods: {
        getPostsByCategorySlug(slug){
            this.posts = [];
            axios.get('/posts-by-category/'+slug+'?page='+this.page).then(res=>{
                if(res.data.data){
                    this.posts = res.data.data;
                    this.title = this.posts.pop().category.title;
                    this.totalPages = res.data.meta.last_page;
                }
                this.skeleton = false;

            }).catch(err=>{
                console.log(err.response);
            });
        },
    },

    metaInfo(){
        return {
            title: this.title,
        }
    },
    mounted(){
        this.getPostsByCategorySlug(this.$route.name);
    },
    watch: {
        page: {
            handler(){
                this.getPostsByCategorySlug(this.$route.name);
            }
        },
        $route: {
            handler(to, from){
                this.getPostsByCategorySlug(to.name);
            }
        }
    }
}
</script>

<style lang="css" scoped>
</style>
