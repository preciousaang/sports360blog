<template>
    <div>
        <header-component></header-component>
        <div class="text-center mt-2">
            <h2>Football News</h2>
            <v-divider></v-divider>
        </div>
        <v-skeleton-loader v-if="!posts.length" v-for="n in 3" :key="n" type="card, list-item" :loading="loading"></v-skeleton-loader>
        <v-container v-if="posts.length">
            <v-row>
                <v-col cols="12" xs="12" sm="12" lg="8">
                    <post-card v-for="post in posts" :key="post.id" :post="post">

                    </post-card>
                    <div class="text-center">
                        <v-pagination v-model="page" :length="totalPosts">
                        </v-pagination>
                    </div>
                </v-col>
            </v-row>
        </v-container>
        <v-container v-else>
            No Posts
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
            loading: true,
            posts: [],
            totalPosts: 0,
        }
    },
    components: {
        'header-component': HeaderComponent,
        'post-card': PostCard
    },
    methods: {
        getPostsByCategorySlug(slug){
            axios.get('/posts-by-category/'+slug+'?page='+this.page).then(res=>{
                this.loading=false;
                this.posts = res.data.data;
                this.totalPosts = res.data.meta.last_page;
                console.log(res);
            }).catch(err=>{
                this.loading=false;
                console.log(err.response);
            });
        },

    },
    metaInfo: {
        title: 'Football News',
    },
    mounted(){
        this.getPostsByCategorySlug('football-news');
    },
    watch: {
        page: {
            handler(){
                this.getPostsByCategorySlug('football-news');
            }
        }
    }
}
</script>

<style lang="css" scoped>
</style>
