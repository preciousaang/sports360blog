<template>
    <div>
        <header-component></header-component>
        <v-container>
            <v-row>
                <v-col :cols="'9'">
                    <post-card v-for="post of posts" :key="post.id" :post="post"></post-card>
                </v-col>
                <v-col :cols="'3'">
                        <h3>Match Preview</h3>
                        <iframe frameborder="0"  scrolling="no" src="https://www.fctables.com/europeanchampionship/iframe/?type=table&lang_id=2&country=67&template=12&stage=17188&team=186106&timezone=Africa/Lagos&time=24&po=1&ma=1&wi=1&dr=1&los=1&gf=0&ga=0&gd=1&pts=1&ng=0&form=0&width=520&height=700&font=Verdana&fs=12&lh=22&bg=FFFFFF&fc=333333&logo=1&tlink=1&ths=1&thb=1&thba=FFFFFF&thc=000000&bc=dddddd&hob=f5f5f5&hobc=ebe7e7&lc=333333&sh=1&hfb=1&hbc=3bafda&hfc=FFFFFF"></iframe><div style="text-align:center;"></div><a href="https://www.fctables.com/europeanchampionship/" rel="nofollow">FcTables.com</a>

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
