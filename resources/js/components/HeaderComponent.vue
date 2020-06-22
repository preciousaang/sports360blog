<template>
    <div>
        <v-toolbar color="blue">
            <v-toolbar-items>
                <v-btn
                v-for="social in socials"
                :key="social.icon"
                :href="social.link"
                small
                target="_blank"
                class="mx-4"
                dark
                icon
                >
          <v-icon>{{ social.icon }}</v-icon>
        </v-btn>
            </v-toolbar-items>
            <v-spacer></v-spacer>
            <v-toolbar-items class="d-none d-lg-block">               
            <a href="#" onclick="doGTranslate('en|en');return false;" title="English" class="gflag nturl" style="background-position:-0px -0px;"><img src="//gtranslate.net/flags/blank.png" height="16" width="16" alt="English" /></a><a href="#" onclick="doGTranslate('en|fr');return false;" title="French" class="gflag nturl" style="background-position:-200px -100px;"><img src="//gtranslate.net/flags/blank.png" height="16" width="16" alt="French" /></a><a href="#" onclick="doGTranslate('en|de');return false;" title="German" class="gflag nturl" style="background-position:-300px -100px;"><img src="//gtranslate.net/flags/blank.png" height="16" width="16" alt="German" /></a><a href="#" onclick="doGTranslate('en|it');return false;" title="Italian" class="gflag nturl" style="background-position:-600px -100px;"><img src="//gtranslate.net/flags/blank.png" height="16" width="16" alt="Italian" /></a><a href="#" onclick="doGTranslate('en|pt');return false;" title="Portuguese" class="gflag nturl" style="background-position:-300px -200px;"><img src="//gtranslate.net/flags/blank.png" height="16" width="16" alt="Portuguese" /></a><a href="#" onclick="doGTranslate('en|ru');return false;" title="Russian" class="gflag nturl" style="background-position:-500px -200px;"><img src="//gtranslate.net/flags/blank.png" height="16" width="16" alt="Russian" /></a><a href="#" onclick="doGTranslate('en|es');return false;" title="Spanish" class="gflag nturl" style="background-position:-600px -200px;"><img src="//gtranslate.net/flags/blank.png" height="16" width="16" alt="Spanish" /></a>
            <select style=" background-color: white; font-weight: bold;" onchange="doGTranslate(this);"><option value="">Select Language</option><option value="en|en">English</option><option value="en|fr">French</option><option value="en|de">German</option><option value="en|es">Spanish</option><option value="en|sw">Swahili</option></select><div id="google_translate_element2"></div>
            </v-toolbar-items>
        </v-toolbar>
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
                    Main Site
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
                <!-- <v-dialog v-model="mail_dialog" max-width="590">
                    <v-card>                        
                        <v-container>
                            <v-form @submit.prevent="subscribe()">
                                <v-text-field @blur="$v.newsletter.$touch()" :error-messages="newsletterErrors"  placeholder="Subscribe to our Newsletter" v-model="newsletter"></v-text-field>                               
                                <v-btn :disabled="$v.newsletter.$invalid" type="submit" block>Subscribe</v-btn>
                            </v-form>
                        </v-container>
                    </v-card>
                </v-dialog> -->
            </v-toolbar-items>
            <v-btn icon>
                <v-icon @click.stop="dialog=true">mdi-magnify</v-icon>
            </v-btn>
            <!-- <v-btn icon>
               <v-icon @click.stop="mail_dialog=true">mdi-mail</v-icon>
            </v-btn> -->
            <v-app-bar-nav-icon @click="drawer = !drawer" class="d-lg-none d-xl-flex"></v-app-bar-nav-icon>
        </v-toolbar>
        <v-navigation-drawer absolute temporary v-model="drawer">
            <v-img class="logo" height="50" :src="require('./logo.png')" contain></v-img>
            <v-divider></v-divider>
            <select style=" background-color: white; font-weight: bold;" onchange="doGTranslate(this);"><option value="">Select Language</option><option value="en|en">English</option><option value="en|fr">French</option><option value="en|de">German</option><option value="en|es">Spanish</option><option value="en|sw">Swahili</option></select><div id="google_translate_element2"></div>
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
            <v-list-item link target="_blank" href="https://betpro360.com">
                <v-list-item-icon>
                    <v-icon>mdi-ball</v-icon>                    
                </v-list-item-icon>
                <v-list-item-title>Main Site</v-list-item-title>
            </v-list-item>
        </v-list>
        </v-navigation-drawer>
    </div>
</template>

<script>
import {validationMixin} from 'vuelidate';
import {required, email} from 'vuelidate/lib/validators';
import swal from 'sweetalert';
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
             socials: [
                {icon:  'mdi-facebook', link: 'https://web.facebook.com/BetPro360/'},
                {icon: 'mdi-twitter', link: 'https://twitter.com/BetPro_360'},
                {icon: 'mdi-telegram', link: 'http://t.me/BetPro_360'},
                {icon: 'mdi-youtube', link: 'https://www.youtube.com/channel/UCsHODFJ8Dr7xwNbpl7TwqXA?view_as=subscriber'},
                {icon: 'mdi-instagram', link: 'https://www.instagram.com/betpro_360/'},
                {icon: 'mdi-pinterest', link: 'https://www.pinterest.com/BETPRO360/'}
            ],
            drawer: false,
            search: null,
            dialog: false,
            newsletter: null,
            mail_dialog: false,              
        }
    },

    validations: {
        search: {required},
        newsletter: {
                required,
                email,
                isUnique: function(value){
                    if(value==='') return true;
                    return new Promise((resolve, reject)=>{
                        axios.get('/subscriber/'+value).then(res=>{
                            console.log(res);
                            if(res.status==200){
                                resolve(false);
                            }
                        }).catch(err=>{
                            console.log(err.response)
                            resolve(true);
                        });
                    })
                }
            },
    },
    mixins: [validationMixin],
    computed: {
        searchErrors: function(){
            const errors = [];
            if(!this.$v.search.$dirty) return errors;
            !this.$v.search.required && errors.push('This field is required');            
            return errors;
        },

        newsletterErrors: function(){
            const errors = [];
            if(!this.$v.newsletter.$dirty) return errors;
            !this.$v.newsletter.required && errors.push('This field is required');            
            !this.$v.newsletter.email && errors.push('This field must be an email');    
            !this.$v.newsletter.isUnique && errors.push('This email already exists');    
            return errors;
        }

        
    },
    methods: {
        searchPost(){
            this.$v.search.$touch();
            if(this.$v.$invalid) return false;           
            this.$router.push({name: 'search', query: {q: this.search}});
            this.dialog=false;      
        },

        subscribe(){
            this.$v.newsletter.$touch();
            if(this.$v.newsletter.$invalid) return false;       
            axios.post('add-subscriber', {subscriber: this.newsletter}).then(res=>{
                swal({title: 'Thank You for subscribing', icon: 'success'});
                this.newsletter = null;
                this.mail_dialog = false;
                this.$v.$reset();
            }).catch(err=>{
                console.log(err.response);
            })
        }
    },
   
}
</script>

<style lang="css" scoped>
    .logo{
        height: 100%;
    }
</style>
