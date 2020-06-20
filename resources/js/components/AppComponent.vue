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
