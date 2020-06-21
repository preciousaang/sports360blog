<template>
  <div>
      <v-app>

          <v-content>              
              <router-view></router-view>
          </v-content>
        <v-footer
    dark
    padless
  >
    <v-card
      class="flex"
      flat
      tile
    >
      <v-card-title class="blue">
        <strong class="subheading">Get connected with us on social networks!</strong>

        <v-spacer></v-spacer>

        <v-btn
          v-for="social in socials"
          :key="social.icon"
          :href="social.link"
          target="_blank"
          class="mx-4"
          dark
          icon
        >
          <v-icon size="24px">{{ social.icon }}</v-icon>
        </v-btn>
      </v-card-title>

      <v-card-text class="py-2 white--text text-center">
        {{ new Date().getFullYear() }} — <strong>Betpro 360</strong>
        <br>
        Designed by <a style="text-decoration: none; color: white; font-weight: bold;" target="_blank" href="https://wa.me/08097218247">AGZ</a>
      </v-card-text>
    </v-card>
  </v-footer>
      </v-app>

  </div>
</template>

<script>
export default {
    data(){
        return{
            

            socials: [
                {icon:  'mdi-facebook', link: 'https://web.facebook.com/BetPro360/'},
                {icon: 'mdi-twitter', link: 'https://twitter.com/BetPro_360'},
                {icon: 'mdi-telegram', link: 'http://t.me/BetPro_360'},
                {icon: 'mdi-youtube', link: 'https://www.youtube.com/channel/UCsHODFJ8Dr7xwNbpl7TwqXA?view_as=subscriber'},
                {icon: 'mdi-instagram', link: 'https://www.instagram.com/betpro_360/'},
                {icon: 'mdi-pinterest', link: 'https://www.pinterest.com/BETPRO360/'}
            ]
        }
    },
    methods: {
        listenForChanges(){
            Echo.channel('betpro360').listen('PostCreated', post=>{
                if(!('Notification' in window)){
                    console.log('Web Notification not supported on this browser');
                    return;
                }

                Notification.requestPermission(permission=>{
                    let notification = new Notification('Betpro360', {
                        body: post.title,
                        icon: post.image
                    });

                    notification.onclick = () => {
                        this.$router.push({name: 'single-post', params: {slug: post.slug}});
                    }
                })
            });
        },
    },
    created(){
        this.listenForChanges();
    },
    metaInfo: {
        titleTemplate: '%s | Betpro 360 Blog',
    }
}
</script>

<style lang="css" scoped>

</style>
