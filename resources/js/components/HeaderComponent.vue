<template>
    <div>
        <v-toolbar>
            <v-toolbar-items>
                <router-link to="/">
                    <v-img class="logo" :src="require('./logo.png')" contain></v-img>
                </router-link>
            </v-toolbar-items>
            <v-spacer></v-spacer>

            <v-toolbar-items class="d-none d-lg-block">
                <v-btn dense v-for="item in items" :key="item.text" :to="item.route">
                    {{item.text}}
                </v-btn>
            </v-toolbar-items>
            <v-btn icon>
                <v-icon>mdi-magnify</v-icon>
            </v-btn>
            <v-app-bar-nav-icon @click="drawer = !drawer" class="d-lg-none d-xl-flex"></v-app-bar-nav-icon>
        </v-toolbar>
        <v-navigation-drawer absolute temporary v-model="drawer">
            <v-img class="logo" height="50" :src="require('./logo.png')" contain></v-img>
            <v-divider></v-divider>
            <v-list nav dense>
                <v-list-item-group>
                    <v-list-item :to="item.route" v-for="item in items" :key="item.text">
                        <v-list-item-icon>
                            <v-icon v-text="item.icon"></v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title v-text="item.text">
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list-item-group>

            </v-list>
        </v-navigation-drawer>
    </div>
</template>

<script>
export default {
    data(){
        return {
            items: [
                {text: 'Home', route: '/', icon: 'mdi-home'},
                {text: 'Football News', route: '/football-news', icon: 'mdi-newspaper'},
                {text: 'Sports Lifestyle', route: '/sports-liftstyle', icon: 'mdi-tshirt-crew-outline'},
                {text: 'Match Previews', route: '/sports-previews', icon: 'mdi-microscope'},
                {text: 'About Us', route: '/about-us', icon: 'mdi-account-group'}
            ],
            drawer: false,
        }
    }
}
</script>

<style lang="css" scoped>
    .logo{
        height: 100%;
    }
</style>
