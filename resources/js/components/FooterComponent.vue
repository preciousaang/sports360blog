<template>
<div>
<v-footer
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
        <strong class="text-center">Connect with us on social networks!</strong>

        <v-spacer></v-spacer>

        <v-btn
          v-for="social in socials"
          :key="social.icon"
          :href="social.link"
          target="_blank"
          small
          class="mx-4"
          dark
          icon
        >
          <v-icon>{{ social.icon }}</v-icon>
        </v-btn>
      </v-card-title>

      <v-card-text class="py-2 white--text text-center">
        &copy;{{ new Date().getFullYear() }} — <strong>Betpro 360</strong>
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