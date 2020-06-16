<template>
    <v-container>
        <v-row>
            <v-col cols="12" lg="4" md="4" sm="12">
                <v-card>
                    <v-app-bar>
                        <v-toolbar-title>
                            {{cardTitle}}
                        </v-toolbar-title>
                    </v-app-bar>
                    <template v-if="!category">
                        <v-container>
                            <v-form @submit.prevent="addCategory()">
                                <v-text-field :error-messages="titleErrors" @input="$v.title.$touch()" @blur="$v.title.$touch()" v-model="title" label="Category">
                                </v-text-field>
                                <v-btn type="submit">
                                    Add Category
                                </v-btn>
                            </v-form>
                        </v-container>
                    </template>
                    <template v-else>
                        <v-container v-if="category">
                            <v-form @submit.prevent="editCategory(category.id)">
                                <v-text-field  v-model="category.title" label="Category">
                                </v-text-field>
                                <p v-if="errors.title" class="red--text">
                                    {{errors.title}}
                                </p>
                                <v-btn type="submit">
                                    Edit Category
                                </v-btn>
                            </v-form>
                        </v-container>
                    </template>


                </v-card>

            </v-col>

            <v-col cols="12" lg="8" md="8" sm="12">
                <v-data-table :headers="headers" :loading="loading" :server-items-length="totalCategories" :items="categories" :options.sync="options">
                    <template v-slot:item.actions="{item}">
                        <v-btn small text outlined :to="{name: 'edit-category', params: {id: item.id}}">
                            <v-icon small >
                                mdi-pencil
                            </v-icon>
                        </v-btn>
                        <v-btn small text outlined @click="deleteCategory(item)">
                            <v-icon small>
                                mdi-delete
                            </v-icon>
                        </v-btn>
                    </template>
                </v-data-table>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import axios from 'axios';
import {validationMixin} from 'vuelidate'
import Vuelidate from 'vuelidate'
import {required} from 'vuelidate/lib/validators'
import Vue from 'vue'
Vue.use(Vuelidate);


export default {
    maixins: [validationMixin],
    validations: {
        title: {
               required,
               isUnique(value){
                   if(value==='') return true;
                   return new Promise((resolve, reject)=>{
                       axios.get('/category?title='+value).then(res=>{
                           if(res.data.title){
                               resolve(false);
                           }else{
                               resolve(true);
                           }
                       })
                   });
               }
           },
    },
    computed: {
        titleErrors(){
            const errors = [];
            if(!this.$v.title.$dirty) return errors;
            !this.$v.title.required && errors.push('Title is required');
            !this.$v.title.isUnique && errors.push('Title already exists');
            return errors;
        },
    },
    data() {
        return {
            categories: [],
            cardTitle: null,
            errors: {},
            category: null,
            newCategory: false,
            totalCategories: 0,
            options: {},
            loading: true,
            headers: [
                {text: 'Title', align: 'start', value: 'title', sortable: false},
                {text: 'Date Created', value: 'created_at', sortable: false},
                {text: 'Date Updated', value: 'updated_at', sortable: false},
                {text: 'Action', value: 'actions', sortable: false}
            ],
            title: null,
        }
    },


    methods: {
        getCategories: function(){
            return new Promise((resolve, reject)=>{
                const {sortBy, sortDesc, page, itemsPerPage} = this.options;
                axios.get('/categories?page='+page).then(res=>{
                    let items = res.data.data;
                    this.loading=false;
                    this.options.itemsPerPage = res.data.per_page;
                    const total = res.data.total;
                    resolve({items, total});
                });
            });
        },
        deleteCategory(item){
            if(confirm('Are You Sure?')){
                axios.delete('/category/'+item.id).then(res=>{
                    this.categories.splice(item, 1);
                    return true;
                }).catch(err=>{
                    //console.log(err.response);
                });
            }
            return false;
        },
        getCategory: function(id){
            axios.get('/category/'+id).then(res=>{
                this.category = res.data;
                this.title = this.category.title;
            }).catch(err=>{

            })
        },
        editCategory: function(id){
            this.errors={};
            if(!this.category.title){
                this.errors.title = "Title is required";
            }
            if(Object.keys(this.errors).length) return false;
            axios.put('/category/'+id, {title: this.category.title}).then(res=>{
                swal({title: 'Category updated successfully', icon: 'success'});
                this.getCategories().then(data=>{
                    this.categories = data.items;
                    this.totalCategories = data.total;
                });
            }).catch(err=>{
                swal({title: err.response.data.errors.title[0], icon: "error"});
            })
        },
        addCategory: function(){
            this.$v.$touch();
            if(this.$v.$invalid) return false;
            axios.post('/category', {title: this.title}).then(res=>{
                this.categories.push(res.data);
                this.title=null;
                this.$v.$reset();
            }).catch(err=>{
                swal({title: 'Server Error', text: 'Try again', icon: 'error'});

            })
        }

    },
    watch: {
        options: {
            handler(){

                this.getCategories().then(data=>{
                    this.categories = data.items;
                    this.totalCategories = data.total;
                }).catch(err=>{

                });
            },
            deep: true
        },
        $route: {
            handler(to, from){
                this.errors={};
                this.getCategory(to.params.id);
                this.getCategories().then(data=>{
                    this.categories = data.items;
                    this.totalCategories = data.total;
                }).catch(err=>{

                });
            }
        }
    },
    mounted(){
        if(this.$route.name==='edit-category'){
            this.cardTitle = 'Edit Category'
            this.getCategory(this.$route.params.id);
        }else{
            this.cardTitle = 'Add Category'
        }
        this.getCategories().then(data=>{
            this.categories = data.items;
            this.totalCategories = data.total;
        }).catch(err=>{

        });
    },
    metaInfo: {
        title: 'Manage Categories',
    },

}
</script>

<style lang="css" scoped>
</style>
