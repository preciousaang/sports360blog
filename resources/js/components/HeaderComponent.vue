<template>
    <div>
        <v-toolbar dense>
            <v-toolbar-toolbar-title><h3>Bet 360 Pro Blog</h3></v-toolbar-toolbar-title>

            <v-spacer></v-spacer>

              <ul class="navbar">
                  <li v-for="item in items" class="nav-item">
                      <a class="nav-link black--text title" :to="item.route" href="#">{{item.text}}</a>
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
}
</script>

<style lang="css" scoped>
</style>
