<template>
    <v-container>
        <v-row justify-content-center>
            <v-col cols="10">
                <v-card>
                    <v-app-bar dark>
                        <v-toolbar-title>
                            Manage Users
                        </v-toolbar-title>
                    </v-app-bar>
                    <v-container>
                        <v-data-table
                            page.sync="page"
                            v-on:update:page="updatePage($event)"
                            v-on:update:options="updateOptions($event)"
                            :items="users"
                            items-per-page.sync="per_page"
                            :server-items-length="usersCount"
                            :options.sync="options"
                            :loading="loading"
                            :headers="headers">
                            <template v-slot:item.actions="{item}">
                                <v-btn title="Edit User" :to="{name: 'edit-user', params: {id: item.id}}" small text>
                                    <v-icon small>
                                        mdi-pencil
                                    </v-icon>
                                </v-btn>
                                <v-btn @click="deleteUser(item)" small text>
                                    <v-icon>
                                        mdi-delete
                                    </v-icon>
                                </v-btn>
                            </template>

                        </v-data-table>
                    </v-container>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
export default {
    metaInfo: {
        title: 'Manage Users'
    },
    data(){
        return {
            headers: [
                {text: 'Name', align: 'start', value: 'name', sortable: false},
                {text: 'Username', value: 'username', sortable: false},
                {text: 'E-Mail', value: 'email', sortable: false},
                {text: 'Action', value: 'actions', sortable: false}
            ],
            page: 1,
            users: [],
            loading: true,
            options: {},
            usersCount: 0,
            per_page: 0,
        }
    },
    methods: {
        getUsers(page, per_page){
            axios.get('/users-list?page='+page+'&per_page='+per_page).then(res=>{
                this.loading = false;
                this.usersCount = res.data.total,
                this.users = res.data.data;
            }).catch(err=>{
                this.loading = false;
                console.log(err.response);
            })
        },
        updatePage(event){
            this.getUsers(event, this.options.itemsPerPage)
        },
        updateOptions(event){
            this.getUsers(event.page, event.itemsPerPage);
        }
    },
    mounted(){
        this.getUsers(this.page, this.per_page);
    },

}
</script>

<style lang="css" scoped>
</style>
