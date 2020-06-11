<template>
  <div>
      <header-component></header-component>
      <v-content>
          <v-container>
              <v-row :justify="'center'">
                  <v-col :cols="'8'">
                      <v-card>
                          <v-app-bar flat>
                            <v-toolbar-title>
                                Add Post
                            </v-toolbar-title>
                          </v-app-bar>
                          <v-container>
                              <v-form @submit.prevent="">
                                  <v-text-field v-model="title" label="Post Title"></v-text-field>
                                  <v-textarea v-model="body" label="Post Body"></v-textarea>
                                  <v-file-input label="Image" v-model="image"></v-file-input>
                                  <v-btn class="ml-8" type="submit">
                                      Add Post
                                  </v-btn>
                              </v-form>
                          </v-container>

                      </v-card>
                  </v-col>
              </v-row>
          </v-container>
      </v-content>
  </div>
</template>

<script>
import axios from 'axios';
import {validationMixin} from 'vuelidate';
import {required, maxlength, email} from 'vuelidate/lib/validators';

import HeaderComponent from '../AdminHeaderComponent';
export default {
    mixins: [validationMixin],
    data(){
        return {
            title: null,
            body: null,
            image: null
        }
    },
    components: {
        'header-component': HeaderComponent,
    },
    methods:{
        getUser: function(){

            axios.get('api/user').then(response=>{
                console.log(response);
            }).catch(error=>{
                console.log(error.response);
            })
        }
    },
    created: function(){
        this.getUser();
    },
}
</script>

<style lang="css" scoped>
</style>
