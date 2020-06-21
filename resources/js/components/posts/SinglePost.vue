<template>
    <div>
        <header-component></header-component>
        <v-container v-if="post">

            <v-row>
                <v-col cols="12" xs="12" md="8" sm="12" lg="8">
                    <h1 class="mb-3">{{post.title}}</h1>
                    <v-divider class="mb-3"></v-divider>
                    <div class="d-flex">
                        <p><v-icon>mdi-account</v-icon>&nbsp;Posted By {{post.user.name}}</p>
                        <v-spacer></v-spacer>
                        <p>
                            <v-icon>mdi-clock</v-icon>&nbsp;{{post.created_at | moment('from')}}
                        </p>
                    </div>
                    <v-card>
                        <v-img :src="post.image"></v-img>
                        <v-divider class="mt-3 mb-5">
                        </v-divider>
                        
                        <div class="sharethis-inline-share-buttons"></div>
                        <v-divider class="mt-3 mb-5"></v-divider>
                        <v-card-text class="px-5 post-body text-subtitle-1"  v-html="post.body">

                        </v-card-text>
                    </v-card>
                </v-col>
                <v-col cols="12" xs="12" md="4" sm="12" lg="4">
                    <h2>Related Posts</h2>
                    <v-divider class="mb-2"></v-divider>
                    <template v-if="relatedPosts.length" v-for="relatedPost in relatedPosts">
                        <v-row no-gutters>
                            <v-col cols="4">
                                <v-img height="100%" :src="relatedPost.image"></v-img>
                            </v-col>
                            <v-col cols="8">
                                <v-card :to="{name: 'single-post', params: {slug: relatedPost.slug}}" style="border-radius-top-left: 0; border-radius-bottom-left: 0;" height="100%">
                                    <h3 class="px-2">{{relatedPost.title}}</h3>
                                    <v-divider></v-divider>
                                    <v-card-subtitle>Published {{relatedPost.created_at|moment('from')}}</v-card-subtitle>
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
import HeaderComponent from '../HeaderComponent';
import axios from 'axios';
export default {
    components: {
        'header-component': HeaderComponent,
    },
    data(){
        return {
            post: null,
            relatedPosts: [],
        }
    },
    methods: {
        getPost: function(slug){
            axios.get('/post-by-slug/'+slug).then(res=>{
                this.post = res.data;
                this.getPostsByCategorySlug(this.post);
            }).catch(err=>{
                console.log(err.response);
            });
        },



        getPostsByCategorySlug(post){
            this.posts = [];
            axios.get('/posts-by-category/'+post.category.slug+'?limit=5').then(res=>{
                this.relatedPosts = res.data.data.filter(item=>{
                    return item.id !== post.id;
                });
            }).catch(err=>{
                console.log(err.response);
            });
        },
    },
 
    metaInfo(){
        return {
            title: this.post ? this.post.title : 'Post Not Found',
            meta: [
                {
                    vmid: 'description',
                    name: 'description',
                    content: this.post ? this.post.body.substring(0, 100) : ''
                },
                {
                    name: 'author',
                    content: this.post ? this.post.user.name : 'Betpro360'
                },
                {
                    property: 'og:url',
                    content: this.post ? (window.location.origin) + this.$route.path : ''
                },
                {
                    property: 'og:type',
                    content: 'article',
                },
                {
                    property: 'og:title',
                    content: this.post ? this.post.title : 'Post Not Found',
                },
                {
                    property: 'og:description',
                    content: this.post ? this.post.body.substring(0, 100) : ''
                },
                {
                    property: 'og:image',
                    content: this.post ? this.post.image : ''
                }
            ]
        }
    },
    mounted(){
        this.getPost(this.$route.params.slug);
        // As an instance method inside a component
        this.$loadScript("https://platform-api.sharethis.com/js/sharethis.js#property=5eee41b6a922da001296fa2a&product=inline-share-buttons&cms=website")
        .then(() => {
        // Script is loaded, do something
        })
        .catch(() => {
        // Failed to fetch script
        });
    },
    watch: {
        $route(to, from){
            this.getPost(to.params.slug);
        }
    }
}
</script>

<style lang="css" scoped>
    .post-body{
        font-family: serif;
        color: black;
        font-size: 135%;
    }
</style>
