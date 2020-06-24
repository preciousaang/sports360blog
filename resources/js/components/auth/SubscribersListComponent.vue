<template>
    <div>
     <header-component></header-component>
    <v-container>
        <v-row justify-content-center>
            <v-col cols="10">
                <v-card>
                    <v-app-bar dark>
                        <v-toolbar-title>
                            Subscribers List
                        </v-toolbar-title>
                    </v-app-bar>
                    <v-container>
                        <v-data-table
                            page.sync="page"
                            v-on:update:page="updatePage($event)"
                            v-on:update:options="updateOptions($event)"
                            :items="subscribers"
                            items-per-page.sync="per_page"
                            :server-items-length="subscribersCount"
                            :options.sync="options"
                            :loading="loading"
                            :headers="headers">                            

                        </v-data-table>
                    </v-container>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
    </div>
</template>

<script>
import AdminHeaderComponent from './AdminHeaderComponent';
export default {
    metaInfo: {
        title: 'Subscribers List'
    },
    data(){
        return {
            headers: [                
                {text: 'E-Mail', value: 'email', sortable: false},                
            ],
            page: 1,
            subscribers: [],
            loading: true,
            options: {},
            subscribersCount: 0,
            per_page: 0,
        }
    },
    components: {
        'header-component': AdminHeaderComponent
    },
    methods: {
        getSubscribers(page, per_page){
            axios.get('/subscribers?page='+page+'&per_page='+per_page).then(res=>{
                this.loading = false;
                this.subscribersCount = res.data.total,
                this.subscribers = res.data.data;
            }).catch(err=>{
                this.loading = false;
                console.log(err.response);
            })
        },
        
        updatePage(event){
            this.getSubscribers(event, this.options.itemsPerPage)
        },
        updateOptions(event){
            this.getSubscribers(event.page, event.itemsPerPage);
        }
    },
    mounted(){
        this.getSubscribers(this.page, this.per_page);
    },

}
</script>

<style lang="css" scoped>
</style>
