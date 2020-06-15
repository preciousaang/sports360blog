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
                            <tiptap-vuetify  placeholder="Post Body" :extensions="extensions" @input="$v.body.$touch()" @blur="$v.body.$touch()" v-model="body" label="Post Body"></tiptap-vuetify>

                                <p class="caption red--text">{{this.bodyErrors[0]}}</p>

                            <v-file-input :error-messages="imageErrors" @input="$v.image.$touch()" @blur="$v.image.$touch()" label="Post Image" ref="files" v-model="image"></v-file-input>
                            <v-btn class="ml-8" type="submit">
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
import { TiptapVuetify, Heading, Bold, Italic, Image, Strike, Underline, Code, Paragraph, BulletList, OrderedList, ListItem, Link, Blockquote, HardBreak, HorizontalRule, History } from 'tiptap-vuetify'
export default {
    components: {
        TiptapVuetify
    },
    mixins: [validationMixin],
    validations: {
        title: {required},
        body: {required},
        image: {required}
    },
    metaInfo: {
        title: 'Add New Post'
    },
    data(){
        return {
            title: null,
            body: null,
            image: null,
            extensions: [
                History,
                 Blockquote,
                 Link,
                 Underline,
                 Strike,
                 Italic,
                 ListItem,
                 Image,
                 BulletList,
                 OrderedList,
                 [Heading, {
                   options: {
                     levels: [1, 2, 3]
                   }
                 }],
                 Bold,
                 Code,
                 HorizontalRule,
                 Paragraph,
                 HardBreak
            ],
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
    methods: {
        addPost: function(){
            this.$v.$touch();
            if(this.$v.$invalid) return false;
            let formData = new FormData();
            formData.append('title', this.title);
            formData.append('body', this.body);
            formData.append('image', this.$refs.files.value);
            axios.post('/add-post', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(response=>{
                swal({title: 'Post Created Successfully', icon: 'success'});
                this.$router.push({name: 'edit-post', params: {id: response.data.id}});
            }).catch(err=>{
                swal("", "Something Went Wrong", "error");
            });
        }
    },
    
}
</script>

<style lang="css" scoped>
</style>
