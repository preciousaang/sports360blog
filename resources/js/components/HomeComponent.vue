<template>
    <div>
        <header-component></header-component>
        <v-container>
            <v-row>
                <v-col xs="12" sm="12" lg="8">
                    <post-card v-for="post of posts" :key="post.id" :post="post"></post-card>
                </v-col>
                <v-col xs="12" sm="12" lg="4">
                    
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
    },
    mounted(){
        this.getPosts();
    }
}
</script>

<style lang="css" scoped>

</style>
