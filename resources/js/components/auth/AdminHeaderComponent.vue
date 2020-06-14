<template>
<div>
    <v-toolbar>
        <!-- <v-app-bar-nav-icon></v-app-bar-nav-icon> -->
        <v-toolbar-title>
            Restricted Area
        </v-toolbar-title>
        <v-spacer></v-spacer>
    </v-toolbar>
    <v-navigation-drawer permanent expand-on-hover app>
        <router-link :to="{name: 'dashboard'}">
        <v-img class="logo" height="50" :src="require('../logo.png')" contain></v-img>
        </router-link>
        <v-divider>

        </v-divider>
        <v-list nav dense>
            <v-list-item>
                <v-list-item link :to="{name: 'dashboard'}">
                    <v-list-item-icon>
                        <v-icon>mdi-view-dashboard</v-icon>
                    </v-list-item-icon>
                    <v-list-item-title>
                        Dashboard
                    </v-list-item-title>
                </v-list-item>
            </v-list-item>
        </v-list>
    </v-navigation-drawer>
</div>
</template>

<script>
export default {

}
</script>

<style lang="css" scoped>
.logo{
    height: 100%;
}
</style>
