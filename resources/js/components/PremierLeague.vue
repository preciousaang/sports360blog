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
                            <v-row>
                                <v-col cols="12">
                                    <iframe id="sofa-standings-embed-1-23776" width="100%" height="700"    src="https://www.sofascore.com/tournament/1/23776/standings/tables/embed" frameborder="0" scrolling="no"></iframe>  <div style="font-size:12px;font-family:Arial,sans-serif">Standings provided by <a target="_blank" href="https://www.sofascore.com/">SofaScore LiveScore</a></div>  
                                </v-col>
                            </v-row>
                              
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
        FooterComponent
    },
    mounted() {  
        this.$loadScript("https://www.sofascore.com/bundles/sofascoreweb/js/bin/util/embed.min.js").then(()=>{
             sofa_embed('sofa-standings-embed-1-23776', window)
        }).catch(()=>{})
       
    },
    metaInfo: {
        title: 'Premier League Table'
    }

}
</script>
<style scoped>

</style>