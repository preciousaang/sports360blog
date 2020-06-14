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
                        <v-list-item-content>
                            <v-list-item-title v-text="child.text">
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list-group>

            </template>
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
                    {text: 'Add Post', icon: 'mdi-file', route: {name: 'add-post'}}
                ]},
            ]
        }
    },
    methods: {
        logout(){
            axios.post('/logout').then(res=>{
                this.$router.push({name: 'login'});
            });
        }
    }
}
</script>

<style lang="css" scoped>
.logo{
    height: 100%;
}
</style>
