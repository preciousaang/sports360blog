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
  </div>
</template>

<script>
import HeaderComponent from './HeaderComponent';
export default {
    components: {
        'header-component': HeaderComponent,
    },
    metaInfo: {
        title: 'Page Not Found',
    }
}
</script>

<style lang="css" scoped>
</style>
