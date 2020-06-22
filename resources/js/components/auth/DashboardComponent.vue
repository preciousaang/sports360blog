<template>
  <div>
      <v-container>      
           <h2 v-if="user" class="text-center">Welcome, {{user.name}}</h2>
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
            image: null,
            user: null,
        }
    },
    components: {

    },
    metaInfo(){
        return {
            title: 'Admin Dashboard',
            
        }
    },
    methods:{
        getUser: function(){
            axios.get('/user').then(response=>{
                this.user = response.data.data;
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
