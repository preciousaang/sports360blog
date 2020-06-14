<template>
    <v-container>
        <v-row :justify="'center'">
            <v-col cols="12" md="12" sm="12">
                <v-card v-if="post">
                    <v-app-bar flat dark>
                      <v-toolbar-title>
                          Edit Post
                      </v-toolbar-title>
                    </v-app-bar>
                    <v-container>
                        <v-form>
                            <v-text-field :error-messages="titleErrors" @input="$v.title.$touch()" @blur="$v.title.$touch()" v-model="title" label="Post Title"></v-text-field>
                        </v-form>
                    </v-container>

                </v-card>
                <v-alert type="error" v-else>
                    Post Does Not Exist. <v-btn outlined to="posts">Manage Posts</v-btn>
                </v-alert>
            </v-col>
        </v-row>
    </v-container>

</template>

<script>
import axios from 'axios';
import {validationMixin} from 'vuelidate';
import {required} from 'vuelidate/lib/validators';
import swal from 'sweetalert';
export default {
    data(){
        return{
            post: null,
            title: null,
            body: null,
            image: null,
        }
    },
    metaInfo: {
        title: 'Edit Post'
    },
    mixins: [validationMixin],
    validations: {
        title: {required},
        body: {required},
        image: {required}
    },
    methods: {
        getPost(id){
            axios.get('/post/'+id).then(res=>{
                this.post = res.data;
                this.title = this.post.title,
                this.body = this.post.body
            }).catch(err=>{
                console.log(err);
            })
        }
    },
    computed: {
        titleErrors(){
            const errors = [];
            if(!this.$v.title.$dirty) return errors;
            !this.$v.title.required && errors.push('Title is required');

            return errors;
        },

        imageErrors(){
            const errors = [];
            if(!this.$v.image.$dirty) return errors;
            !this.$v.image.required && errors.push('Image is required');

            return errors;
        },

        bodyErrors(){
            const errors = [];
            if(!this.$v.body.$dirty) return errors;
            !this.$v.body.required && errors.push('Body is required');
            return errors;
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
