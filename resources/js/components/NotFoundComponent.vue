<template>
  <div>
      <header-component></header-component>
      <v-container class="grey mt-12">
        <v-row style="height: 100%;" align="center">
            <v-col>
                <h1 class="text-center white--text">Page Not Found</h1>
            </v-col>
        </v-row>
      </v-container>
       <footer-component></footer-component>
  </div>
</template>

<script>
import HeaderComponent from './HeaderComponent';
import FooterComponent from './FooterComponent';
export default {
    components: {
        'header-component': HeaderComponent,
        FooterComponent,
    },
    metaInfo: {
        title: 'Page Not Found',
    }
}
</script>

<style lang="css" scoped>
</style>
