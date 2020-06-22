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
