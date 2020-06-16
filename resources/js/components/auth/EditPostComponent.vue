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
                        <v-form @submit.prevent="updatePost()">
                            <v-text-field  v-model="post.title" label="Post Title"></v-text-field>
                            <p v-if="errors.title" class="red--text" v-text="errors.title">

                            </p>
                            <v-select v-model="post.category" item-text="title" item-value="id" label="Category" :items="categories">
                            </v-select>
                            <p v-if="errors.category" class="red--text" v-text="errors.category">

                            </p>
                            <wysiwyg  placeholder="Post Body" v-model="post.body" label="Post Body"></wysiwyg>
                            <p v-if="errors.body" class="red--text" v-text="errors.body">

                            </p>


                            <v-card class="mb-3" max-width="200" v-if="!changeImage">
                                <v-img width="200" :src="post.image"></v-img>
                                <v-card-title>
                                    Post Image
                                </v-card-title>
                                <v-card-actions>
                                    <v-btn small @click="changeImage=!changeImage">
                                        Change Image
                                    </v-btn>
                                </v-card-actions>
                            </v-card>

                            <template v-else>
                                <v-file-input  accept="image/*"  v-model="image"  label="Post Image" ref="files"></v-file-input>
                            </template>

                            <p v-if="errors.image" class="red--text" v-text="errors.image">

                            </p>
                            <v-container fluid>
                                <v-switch v-model="post.published" label="Published"></v-switch>
                                <v-switch v-model="post.featured"  label="Featured"></v-switch>
                            </v-container>
                            <v-btn :disabled="this.disabled" class="ml-8" type="submit">
                                Update Post
                            </v-btn>
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
import swal from 'sweetalert';
export default {
    data(){
        return{
            categories: [],
            errors: {},
            post: null,
            image: null,
            changeImage: false,
            disabled: false,
        }
    },
    metaInfo: {
        title: 'Edit Post'
    },


    methods: {
        getPost(id){
            axios.get('/post/'+id).then(res=>{
                this.post = res.data;
                this.featured = res.data.featured;
                this.published = res.data.published;
            }).catch(err=>{
                console.log(err);
            })
        },
        updatePost: function(){
            this.errors = {};
            if(!this.post.title){
                swal({title: 'Post Title is required', icon: 'error'})
                this.errors.title = 'Title is required';
            }

            if(!this.post.body){
                this.errors.body = 'Body is required';
                swal({title: 'Body is required', icon: 'error'})
            }

            if(!this.post.category){
                this.errors.category = 'Category is required';
                swal({title: 'The Category is required', icon: 'error'});
            }

            if(this.$refs.files){
                if(!this.image){
                    this.errors.image = "Image is required";
                    swal({title: 'Image is required', icon: 'error'})
                }
            }

            if(Object.keys(this.errors).length){
                return false;
            }
            const id = this.$route.params.id;
            let formData = new FormData();
            formData.append('title', this.post.title);
            formData.append('body', this.post.body);
            formData.append('category', JSON.stringify(this.post.category));
            formData.append('published', JSON.stringify(this.post.published));
            formData.append('featured', JSON.stringify(this.post.featured));
            if(this.$refs.files){
                formData.append('image', this.$refs.files.value);
            }
            this.disabled = true;
            axios.post('/post/'+this.post.id+'/edit', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(res=>{
                this.disabled=false;
                swal({title: 'Updated Successfully', icon: 'success'});
                this.$router.push({name: 'edit-post', params: {id: this.post.id}});
            }).catch(err=>{
                this.disabled=false;
                swal({title: 'Server Error', icon: 'error'})
                console.log(err.response);
            })
        },
        getCategories: function(){
            axios.get('/all-categories').then(res=>{
                this.categories = res.data;
            }).catch(err=>{
                console.log(err.response);
            });
        }
    },

    mounted(){
        this.getPost(this.$route.params.id);
        this.getCategories();
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
