<template>
    <div>
        <v-toolbar>
            <v-toolbar-items>
                <router-link :to="{name: 'homepage'}" exact>
                    <v-img class="logo" :src="require('./logo.png')" contain></v-img>
                </router-link>
            </v-toolbar-items>
            <v-spacer></v-spacer>

            <v-toolbar-items class="d-none d-lg-block">
                <template v-for="item in items">
                    <v-btn v-if="!item.children" text :to="item.route" exact>
                        {{item.text}}
                    </v-btn>
                     <v-menu v-else offset-y>
                          <template v-slot:activator="{ on, attrs }">
                            <v-btn
                              v-bind="attrs"
                              v-on="on"
                              exact
                            >
                              {{item.text}}<v-icon class="ml-auto">
                                  mdi-menu-down
                              </v-icon>
                            </v-btn>
                          </template>
                          <v-list>
                            <v-list-item
                              v-for="(child, index) in item.children"
                              :href="child.route"
                              :key="index"
                              @click=""
                            >
                              <v-list-item-title>{{ child.text }}</v-list-item-title>
                            </v-list-item>
                          </v-list>
                        </v-menu>
                </template>

                <v-btn target="_blank" href="https://betpro360.com" exact>
                    Betpro360
                </v-btn>
                <v-dialog v-model="dialog" max-width="590">
                    <v-card>
                        <v-container>
                            <v-form @submit.prevent="searchPost()">
                                <v-text-field @input="$v.search.$touch()" @blur="$v.search.$touch()" :error-messages="searchErrors" placeholder="Search......" v-model="search"></v-text-field>
                                <v-btn :disabled="$v.$invalid" type="submit" block>Search</v-btn>
                            </v-form>
                        </v-container>
                    </v-card>
                </v-dialog>
            </v-toolbar-items>
            <v-btn icon>
                <v-icon @click.stop="dialog=true">mdi-magnify</v-icon>
            </v-btn>
            <v-app-bar-nav-icon @click="drawer = !drawer" class="d-lg-none d-xl-flex"></v-app-bar-nav-icon>
        </v-toolbar>
        <v-navigation-drawer absolute temporary v-model="drawer">
            <v-img class="logo" height="50" :src="require('./logo.png')" contain></v-img>
            <v-divider></v-divider>
            <v-list nav dense flat>
            <template v-for="item in items">
                <v-list-item v-if="!item.children" link :to="item.route">
                    <v-list-item-icon>
                        <v-icon v-text="item.icon"></v-icon>
                    </v-list-item-icon>
                    <v-list-item-title v-text="item.text">
                    </v-list-item-title>
                </v-list-item>
                <v-list-group :prepend-icon="item.icon" v-else no-action>
                    <template v-slot:activator>
                      <v-list-item-content>
                        <v-list-item-title v-text="item.text"></v-list-item-title>
                      </v-list-item-content>
                    </template>
                    <v-list-item :href="child.route" v-for="child in item.children" :key="child.text">
                        <v-list-item-content>
                            <v-list-item-title v-text="child.text">
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list-group>
            </template>
        </v-list>
        </v-navigation-drawer>
    </div>
</template>

<script>
import {validationMixin} from 'vuelidate';
import {required} from 'vuelidate/lib/validators';
export default {
    data(){
        return {
            items: [
                {text: 'Home', route: {name: 'homepage'}, icon: 'mdi-home'},
                {text: 'Football News', route: '/football-news', icon: 'mdi-newspaper'},
                {text: 'Sports Lifestyle', route: '/sports-lifestyle', icon: 'mdi-tshirt-crew-outline'},
                {text: 'Match Previews', route: '/match-previews', icon: 'mdi-microscope'},
                {text: 'League Table', route: '#', icon: 'mdi-table', children: [
                    {text: 'Champions League', route: '/champions-league-table', icon: 'mdi-ball'},
                    {text: 'Premier League', route: '/premier-league-table', icon: 'mdi-ball'},
                    {text: 'Serie A', route: '/serie-a-table', icon: 'mdi-ball'},
                    {text: 'LA Liga', route: '/la-liga-table', icon: 'mdi-ball'},
                    {text: 'Bundesliga', route: '/bundesliga-table', icon: 'mdi-ball'},
                    {text: 'League 1', route: '/league-1-table', icon: 'mdi-ball'},
                ]},
                {text: 'About Us', route: {name: 'about-us'}, icon: 'mdi-account-group'}
            ],
            drawer: false,
            search: null,
            dialog: false,            
        }
    },

    validations: {
        search: {required}
    },
    mixins: [validationMixin],
    computed: {
        searchErrors: function(){
            const errors = [];
            if(!this.$v.search.$dirty) return errors;
            !this.$v.search.required && errors.push('This field is required');
            return errors;
        }
    },
    methods: {
        searchPost(){
            this.$v.$touch();
            if(this.$v.$invalid) return false;           
            this.$router.push({name: 'search', query: {q: this.search}});
            this.dialog=false;      
        }
    },
   
}
</script>

<style lang="css" scoped>
    .logo{
        height: 100%;
    }
</style>
