<template>
    <div>
        <v-toolbar dense>
            <v-toolbar-title><h3>Bet 360 Pro Blog</h3></v-toolbar-title>

            <v-spacer></v-spacer>

              <ul class="navbar">
                  <li v-for="item in items" class="nav-item">
                      <router-link class="nav-link black--text title" :to="item.route">{{item.text}}</router-link>
                  </li>
              </ul>

           </v-list>
            <v-spacer></v-spacer>

            <v-btn icon>
                <v-icon>mdi-magnify</v-icon>
            </v-btn>
        </v-toolbar>
    </div>
</template>

<script>
export default {
    data(){
        return {
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
