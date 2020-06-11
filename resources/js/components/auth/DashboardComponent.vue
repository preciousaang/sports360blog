<template>
  <div>
      <header-component></header-component>
      <v-content>

      </v-content>
  </div>
</template>

<script>
import axios from 'axios';


import HeaderComponent from '../AdminHeaderComponent';
export default {
    data(){
        return {
            title: null,
            body: null,
            image: null
        }
    },
    components: {
        'header-component': HeaderComponent,
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
