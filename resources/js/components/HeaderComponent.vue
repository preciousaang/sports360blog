<template>
    <div>
        <v-toolbar>
            <v-img class="logo" :src="require('./logo.png')" contain>

            </v-img>


            <v-spacer></v-spacer>

            <v-toolbar-items>
                <v-btn dense v-for="item in items" :key="item.text" :to="item.route">
                    {{item.text}}
                </v-btn>
            </v-toolbar-items>
            <v-btn icon>
                <v-icon>mdi-magnify</v-icon>
            </v-btn>
        </v-toolbar>
    </div>
</template>

<script>
export default {
    data(){
        return {
            items: [
                {text: 'Home', route: '/'},
                {text: 'Football News', route: '/football-news'},
                {text: 'Sports Lifestyle', route: '/sports-liftstyle'},
                {text: 'Match Previews', route: '/sports-previews'},
                {text: 'About Us', route: '/about-us'}
            ]
        }
    }
}
</script>

<style lang="css" scoped>
    .logo{
        height: 100%;        
    }
</style>
