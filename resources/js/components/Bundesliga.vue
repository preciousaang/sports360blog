<template>
    <div>
        <header-component></header-component>
        <v-container>
            <v-row justify-content-center>
                <v-col cols="9">
                    <v-card>
                        <v-app-bar dark>
                            <v-toolbar-title>
                                Bundesliga
                            </v-toolbar-title>
                        </v-app-bar>
                        <v-container>
                              <iframe id="sofa-standings-embed-33-24644" width="100%" height="700"    src="https://www.sofascore.com/tournament/33/24644/standings/tables/embed" frameborder="0" scrolling="no"></iframe>  <div style="font-size:12px;font-family:Arial,sans-serif">Standings provided by <a target="_blank" href="https://www.sofascore.com/">SofaScore LiveScore</a></div>
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
        
    },
    metaInfo: {
        title: 'Bundesliga Table'
    }

}
</script>
<style scoped>

</style>