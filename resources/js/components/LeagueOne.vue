<template>
    <div>
        <header-component></header-component>
        <v-container>
            <v-row justify-content-center>
                <v-col cols="9">
                    <v-card>
                        <v-app-bar dark>
                            <v-toolbar-title>
                                League One
                            </v-toolbar-title>
                        </v-app-bar>
                        <v-container>
                              <iframe id="sofa-standings-embed-4-23872" width="100%" height="700"    src="https://www.sofascore.com/tournament/4/23872/standings/tables/embed" frameborder="0" scrolling="no"></iframe>  <div style="font-size:12px;font-family:Arial,sans-serif">Standings provided by <a target="_blank" href="https://www.sofascore.com/">SofaScore LiveScore</a></div>
                        </v-container>

                    </v-card>
                </v-col>
            </v-row>
        </v-container>
        <footer-component></footer-component>
    </div>
</template>
<script>
import HeaderComponent from './HeaderComponent'
import FooterComponent from './FooterComponent'
export default {
    components: {
        'header-component': HeaderComponent,
        FooterComponent,
    },
    mounted() {
        
    },
    metaInfo: {
        title: 'League One Table'
    }

}
</script>
<style scoped>

</style>