<template>
<div>
    <v-navigation-drawer permanent expand-on-hover app>
        <router-link :to="{name: 'dashboard'}">
        <v-img class="logo" height="50" :src="require('../logo.png')" contain></v-img>
        </router-link>
        <v-divider>

        </v-divider>
        <v-list nav dense flat>
            <template v-for="item in items">
                <v-list-item v-if="!item.children" link :to="item.route">
                    <v-list-item-icon>
                        <v-icon v-text="item.icon"></v-icon>
                    </v-list-item-icon>
                    <v-list-item-title v-text="item.text">
                    </v-list-item-title>
                </v-list-item>                
                <v-list-group :prepend-icon="item.icon" v-else no-action>
                    <template v-slot:activator>
                      <v-list-item-content>
                        <v-list-item-title v-text="item.text"></v-list-item-title>
                      </v-list-item-content>
                    </template>
                    <v-list-item :to="child.route" v-for="child in item.children" :key="child.text">
                        <v-list-item-icon>
                            <v-icon v-text="child.icon">

                            </v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title v-text="child.text">
                            </v-list-item-title>
                        </v-list-item-content>                                                

                    </v-list-item>
                </v-list-group>
            </template>
            <v-list-group v-if="user && user.role.title=='admin'" prepend-icon="mdi-account-settings" no-action>
                    <template v-slot:activator>
                      <v-list-item-content>
                        <v-list-item-title>Users</v-list-item-title>
                      </v-list-item-content>
                    </template>
                    <v-list-item :to="child.route" v-for="child in users_menu" :key="child.text">
                        <v-list-item-icon>
                            <v-icon v-text="child.icon">

                            </v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title v-text="child.text">
                            </v-list-item-title>
                        </v-list-item-content>                                                

                    </v-list-item>
            </v-list-group>
           <v-list-item link :to="{name: 'profile'}">
                    <v-list-item-icon>
                        <v-icon>mdi-account</v-icon>
                    </v-list-item-icon>
                    <v-list-item-title>
                        Update Account
                    </v-list-item-title>
                </v-list-item>    
            <v-list-item @click.prevent="logout()" link>
                <v-list-item-icon>
                    <v-icon>mdi-logout</v-icon>
                </v-list-item-icon>
                <v-list-item-title >
                    Logout
                </v-list-item-title>
            </v-list-item>
        </v-list>
    </v-navigation-drawer>
</div>
</template>

<script>
import axios from 'axios';
export default {
    data(){
        return {
            items: [
                {text: 'Dashboard', icon: 'mdi-view-dashboard', route: {name: 'dashboard'}},
                {text: 'Posts', icon: 'mdi-file', route: '#', children: [
                    {text: 'Add Post', icon: 'mdi-file-plus', route: {name: 'add-post'}},
                    {text: 'Manage Posts', icon: 'mdi-file', route: {name: 'manage-posts'}},
                    {text: 'Categories', icon: 'mdi-file', route: {name: 'manage-categories'}},

                ]},               
            ],
            users_menu: [
                {text: 'Add User', icon: 'mdi-account-plus', route: {name: 'add-user'}},
                {text: 'Manage Users', icon: 'mdi-account-details', route: {name: 'manage-users'}},
            ],
            user: null,
        }
    },
    methods: {
        logout(){
            if(confirm('Are you sure you want to logout?')){
                axios.post('/logout').then(res=>{
                    this.$router.push({name: 'login'});
                });
            }
            
        },

        getUser: function(){
            axios.get('/user').then(response=>{
                this.user = response.data.data;
                console.log(response);
            }).catch(error=>{
                console.log(error.response);
            })
        }
    },

    created(){
        this.getUser();
    },

    $route: {
        handler(to, from){
            this.getUser();
        }
    }
}
</script>

<style lang="css" scoped>
.logo{
    height: 100%;
}
</style>
