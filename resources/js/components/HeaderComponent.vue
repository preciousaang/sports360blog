<template>
    <div>
        <v-toolbar dense>
            <v-toolbar-title><h3>Bet 360 Pro Blog</h3></v-toolbar-title>

            <v-spacer></v-spacer>

            <v-toolbar-items>
                <v-btn v-for="item in items" :key="item.text" :to="item.route">
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
                {text: 'About Us', route: '/about-us'}
            ]
        }
    }
}
</script>

<style lang="css" scoped>

</style>
