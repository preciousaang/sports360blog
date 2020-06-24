<template>
<div class="mt-6">
<v-footer
          
          height="50px"
          dark
          padless
          absolute
        >
    <v-card
      class="flex"
      flat
      tile
    >
      <v-card-title class="blue">

      <v-row>
      <v-col sm="12" cols="12" lg="8">
        Connect with us on social media
      </v-col>
        
        <v-col sm="12" cols="12" lg="4">

        <v-btn
          v-for="social in socials"
          :key="social.icon"
          :href="social.link"
          link
          target="_blank"
          small
          dense
          icon
          class="mx-3"
        >
          <v-icon>{{ social.icon }}</v-icon>
        </v-btn>
        </v-col>
        </v-row>
      </v-card-title>

      <v-card-text class="py-2 white--text text-center">
        Copyright &copy; 2020 — <a style="color: white;text-decoration: none;font-weight: bold;" target="_blank" href="https://betpro360.com">BetPro360</a> - All Rights Reserved
        <br>
        Designed by <a style="text-decoration: none; color: white; font-weight: bold;" target="_blank" href="https://wa.me/08097218247">AGZ</a>
      </v-card-text>
    </v-card>
  </v-footer>

</div>

</template>

<script>
export default{
    data(){
        return{
            

            socials: [
                {icon: 'mdi-facebook', link: 'https://web.facebook.com/BetPro360/'},
                {icon: 'mdi-twitter', link: 'https://twitter.com/BetPro_360'},
                {icon: 'mdi-telegram', link: 'http://t.me/BetPro_360'},
                {icon: 'mdi-youtube', link: 'https://www.youtube.com/channel/UCsHODFJ8Dr7xwNbpl7TwqXA?view_as=subscriber'},
                {icon: 'mdi-instagram', link: 'https://www.instagram.com/betpro_360/'},
                {icon: 'mdi-pinterest', link: 'https://www.pinterest.com/BETPRO360/'}
            ]
        }
    },
}
</script>