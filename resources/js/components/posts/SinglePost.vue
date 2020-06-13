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
                        <v-divider class="mb-5"></v-divider>
                        <v-card-text v-html="post.body"></v-card-text>
                    </v-card>
                </v-col>
                <v-col cols="12" xs="12" md="4" sm="12" lg="4">
                    <h4>dd</h4>
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
        }
    },
    methods: {
        getPost: function(id){
            axios.get('/post/'+id).then(res=>{
                this.post = res.data;
            }).catch(err=>{
                console.log(err);
            });
        }
    },
    mounted(){
        this.getPost(this.$route.params.id);
    },
    watch: {
        $route(to, from){
            this.getPost(to);
        }
    }
}
</script>

<style lang="css" scoped>
</style>
