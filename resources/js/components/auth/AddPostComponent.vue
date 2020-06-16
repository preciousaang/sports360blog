<template>
<div>
    <v-container>
        <v-row :justify="'center'">
            <v-col cols="12" md="12" sm="12">
                <v-card>
                    <v-app-bar flat dark>
                      <v-toolbar-title>
                          Add Post
                      </v-toolbar-title>

                    </v-app-bar>
                    <v-container>
                        <v-form @submit.prevent="addPost()">
                            <v-text-field :error-messages="titleErrors" @input="$v.title.$touch()" @blur="$v.title.$touch()" v-model="title" label="Post Title"></v-text-field>
                            <v-select :error-messages="categoryErrors"  v-model="post.category" item-text="title" item-value="id" label="Category" :items="categories">
                            </v-select>
                            <br />
                            <wysiwyg  placeholder="Post Body"  @input="$v.body.$touch()" @blur="$v.body.$touch()" v-model="body" label="Post Body"></wysiwyg>
                                <p class="caption red--text">{{this.bodyErrors[0]}}</p>
                            <v-file-input accept="image/*" :error-messages="imageErrors" @input="$v.image.$touch()" @blur="$v.image.$touch()" label="Post Image" ref="files" v-model="image"></v-file-input>
                            <v-container fluid>
                                <v-switch v-model="published" label="Published"></v-switch>
                                <v-switch v-model="featured" label="Featured"></v-switch>
                            </v-container>
                            <v-btn :disabled="disabled" class="ml-8" type="submit">
                                Add Post
                            </v-btn>
                        </v-form>
                    </v-container>

                </v-card>
            </v-col>
        </v-row>
    </v-container>
</div>
</template>

<script>
import {validationMixin} from 'vuelidate';
import {required} from 'vuelidate/lib/validators';
import swal from 'sweetalert';
export default {
    mixins: [validationMixin],
    validations: {
        title: {required},
        body: {required},
        image: {required},
        category: {required}
    },
    metaInfo: {
        title: 'Add New Post'
    },
    data(){
        return {
            categories: [],
            category: null,
            title: null,
            body: null,
            image: null,
            published: true,
            featured: false,
            disabled: false,

        }
    },
    computed: {
        titleErrors(){
            const errors = [];
            if(!this.$v.title.$dirty) return errors;
            !this.$v.title.required && errors.push('Title is required');
            return errors;
        },

        categoryErrors(){
            const errors = [];
            if(!this.$v.category.$dirty) return errors;
            !this.$v.category.required && errors.push('Caetgory is required');
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
    methods: {
        addPost: function(){
            this.$v.$touch();
            if(this.$v.$invalid) return false;
            this.disabled = true;
            let formData = new FormData();
            formData.append('title', this.title);
            formData.append('body', this.body);
            formData.append('category', JSON.stringify(this.category));
            formData.append('published', JSON.stringify(this.published));
            formData.append('featured', JSON.stringify(this.featured));
            formData.append('image', this.$refs.files.value);
            axios.post('/add-post', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(response=>{
                this.disabled = false;
                swal({title: 'Post Created Successfully', icon: 'success'});
                this.$router.push({name: 'edit-post', params: {id: response.data.id}});
            }).catch(err=>{
                this.disabled = false;
                console.error(err.response);
                swal({title: "Server Error", text: "Please try again", icon: "error"});
            });
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
        this.getCategories();
    }
}
</script>

<style lang="css" scoped>
</style>
