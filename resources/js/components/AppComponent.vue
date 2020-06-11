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
                items: [
                    {text: 'Home', route: '/'},
                    {text: 'About Us', route: '/about-us'}
                ]
            }
        }
}
</script>

<style lang="css" scoped>
    ul.navbar{

    }
    li.nav-item{
        display: inline-block;;
        margin-right: 3px;
    }
    a.nav-link{
        text-decoration: none;
    }

    a.nav-link:hover{
        text-decoration: underline;
    }
</style>
