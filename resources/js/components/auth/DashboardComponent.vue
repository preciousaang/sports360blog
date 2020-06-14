<template>
  <div>
      <v-container>
           <h3>Admin Dashboard</h3>
      </v-container>
  </div>
</template>

<script>
import axios from 'axios';


export default {
    data(){
        return {
            title: null,
            body: null,
            image: null
        }
    },
    components: {

    },
    metaInfo(){
        return {
            title: 'Admin Dashboard'
        }
    },
    methods:{
        getUser: function(){
            axios.get('/user').then(response=>{
                console.log(response);
            }).catch(error=>{
                console.log(error.response);
            })
        }
    },
    created: function(){
        this.getUser();
    },
}
</script>

<style lang="css" scoped>
</style>
