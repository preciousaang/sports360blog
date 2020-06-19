<template>
    <div>
        <header-component></header-component>
        <v-container>
            <v-row>
                <v-col cols="12" xs="12" sm="12" lg="8">
                    <v-skeleton-loader v-if="!posts.length" v-for="n in 3" :key="n" type="card, list-item" :loading="loading"></v-skeleton-loader>
                    <post-card v-for="post of posts" :key="post.id" :post="post"></post-card>
                </v-col>
                <v-col cols="12" xs="12" sm="12" lg="4">
                    <h2 class="text-center">Popular Posts</h2>
                    <v-divider class="mb-2"></v-divider>
                    <template v-if="popularPosts.length" v-for="popPost in popularPosts">
                        <v-row no-gutters>
                            <v-col cols="4">
                                <v-img height="100%" :src="popPost.image"></v-img>
                            </v-col>
                            <v-col cols="8">
                                <v-card :to="{name: 'single-post', params: {slug: popPost.slug}}" style="border-radius-top-left: 0; border-radius-bottom-left: 0;" height="100%">
                                    <h3 class="px-2">{{popPost.title}}</h3>
                                    <v-divider></v-divider>
                                    <v-card-subtitle>Published {{popPost.created_at|moment('from')}}</v-card-subtitle>
                                </v-card>
                            </v-col>
                        </v-row>
                        <v-divider class="mb-2 mt-2">

                        </v-divider>
                    </template>
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>

<script>
import HeaderComponent from './HeaderComponent';
import PostCard from './posts/PostCard';
import axios from 'axios';
export default {
    components: {
        'header-component': HeaderComponent,
        'post-card': PostCard
    },
    data(){
        return {
            posts: [],
            loading: true,
            popularPosts: [],
        }
    },
    metaInfo(){
        return {
            title: 'Latest Sports News Around The Globe',
            meta: [
                {
                    vmid: 'description',
                    name: 'description',
                    content: 'Betpro360 blog gives the latest sports news from around the globe... breaking news, sports lifestyle, rumours, transfers, league table standings, detailed match analysis and free betting tips.'
                }
            ]
        }
    },
    methods: {
        getPosts: function(){
            axios.get('/posts').then(res=>{
                this.posts = res.data.data;
            }).catch(err=>{
                console.log(err.response);
            });
        },
        getPopularPosts(){
            this.popularPosts = [];
            axios.get('/popular-posts/')
            .then(res=>{
                console.log(res);
                this.popularPosts = res.data;
            })
            .catch(err=>{
                console.log(err.response);
            })
        }
    },
    mounted(){
        this.getPosts();
        this.getPopularPosts();
    }
}
</script>

<style lang="css" scoped>

</style>
