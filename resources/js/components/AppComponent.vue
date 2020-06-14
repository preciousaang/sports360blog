<template>
  <div>
      <v-app>

          <v-content>
              <router-view></router-view>
          </v-content>

      </v-app>

  </div>
</template>

<script>
export default {
    data(){
        return{

        }
    },
    metaInfo: {
        titleTemplate: '%s | Betpro 360 Blog',
    }
}
</script>

<style lang="css" scoped>

</style>
