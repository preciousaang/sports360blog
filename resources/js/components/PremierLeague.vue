<template>
    <div>
        <header-component></header-component>
        <v-container>
            <v-row justify-content-center>
                <v-col cols="9">
                    <v-card>
                        <v-app-bar dark>
                            <v-toolbar-title>
                                Premier League
                            </v-toolbar-title>
                        </v-app-bar>
                        <v-container>
                            <div id="fs-standings"></div>
                        </v-container>

                    </v-card>
                </v-col>
            </v-row>
        </v-container>

    </div>
</template>
<script>
import HeaderComponent from './HeaderComponent'
export default {
    components: {
        'header-component': HeaderComponent
    },
    mounted() {
        (function (w,d,s,o,f,js,fjs) { w['fsStandingsEmbed']=o;w[o] = w[o] || function () { (w[o].q = w[o].q || []).push(arguments) }; js = d.createElement(s), fjs = d.getElementsByTagName(s)[0]; js.id = o; js.src = f; js.async = 1; fjs.parentNode.insertBefore(js, fjs); }(window, document, 'script', 'mw', 'https://cdn.footystats.org/embeds/standings.js')); mw('params', { leagueID: 2012 });
    },
    metaInfo: {
        title: 'Premier League Table'
    }

}
</script>
<style scoped>

</style>