<template>
    <div>
    <header-component></header-component>
    <v-container>
        <v-row>
            <v-col cols="12" lg="12" md="12" sm="12">
                <v-card>
                    <v-app-bar dark>
                        <v-toolbar-title>
                            Manage Posts
                        </v-toolbar-title>
                        <v-spacer>

                        </v-spacer>
                        <v-btn light :to="{name: 'add-post'}">
                            Add New Post
                        </v-btn>
                    </v-app-bar>
                    <v-data-table :loading="loading" :headers="headers" :items="posts"  :server-items-length="totalPosts" :options.sync="options">
                        <template v-slot:item.actions="{item}">
                            <v-icon small class="mr-2" @click="editItem(item)">
                                mdi-pencil
                            </v-icon>
                            <v-icon small class="mr-2" @click="deleteItem(item)">
                                mdi-delete
                            </v-icon>
                        </template>
                    </v-data-table>
                </v-card>
            </v-col>
        </v-row>

    </v-container>
    </div>

</template>

<script>
import axios from 'axios';
import HeaderComponent from './AdminHeaderComponent'
export default {
    data(){
        return{
            headers: [
                {text: 'Title', align: 'start', value: 'title'},
                {text: 'Categories', value: 'category.title'},
                {text: 'Date Created', value: 'created_at'},
                {text: 'Date Updated', value: 'updated_at'},
                {text: 'Action', value: 'actions', sortable: false}
            ],
            posts: [],
            page: 1,
            totalPosts: 0,
            loading: true,
            options: {},

        }
    },
    components: {
        HeaderComponent
    },
    watch: {
        options: {
            handler(){
                this.getPosts().then(data=>{
                    this.posts = data.items;
                    this.totalPosts = data.total;
                }).catch(err=>{
                    console.log(err.response);
                });
            },
            deep: true
        }
    },
    methods: {
        getPosts: function(){
            //return axios.get('/all-posts');
            return new Promise((resolve, reject)=>{
                this.loading = true;
                const {sortBy, sortDesc, page, itemsPerPage} = this.options;
                axios.get('/all-posts?page='+page).then(data=>{
                    const { sortBy, sortDesc, page, itemsPerPage } = this.options
                    this.loading=false;
                    let items = data.data.data;
                    this.options.itemsPerPage = data.data.meta.per_page;
                    const total = data.data.meta.total;
                    resolve({items, total});
                })
            });
        },
        editItem: function(item){
            this.$router.push({name: 'edit-post', params: {id: item.id}});
        },
        deleteItem: function(item){
            let index = this.posts.indexOf(item);
            if(confirm('Are You Sure?')){
                axios.delete('/post/'+item.id).then(res=>{
                    this.posts.splice(index, 1);
                    swal({title: 'Post Deleted', icon: "info"});
                }).catch(err=>{
                    console.log(err.response);
                })
            }
            return false;
        }
    },
    mounted(){
        this.getPosts().then(data=>{
            this.posts = data.items;
            this.totalPosts = data.total;
        }).catch(err=>{
            console.log(err.response);
        });
    },
    metaInfo: {
        title: 'Manage Posts'
    }
}
</script>

<style lang="css" scoped>
</style>
