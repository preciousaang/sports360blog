<template>
    <div>
        <header-component></header-component>
        <v-container>
            <v-row>
                <v-col cols="12">
                    <h1 class="text-center">About Us</h1>
                    <p>
                        There are a lot of sport betting bookmakers around and their most important goal is to remain in business. It doesn't matter if it's off your sweat.
                        Betting is fun and entertaining - for adults.
                    </p>
                    <p>
                        Winning is what motivates anyone to want more, and when you want more, it's only natural to do more.

                        Making you win is our own most important goal.
                        At BetPro360, we are here to offer you the best platform to successfully turn your passion for the game into a money-making activity.
                    </p>
                    <h2>Here is our pledge to you:</h2>
                    <v-list>

                        <v-list-item>
                            <v-list-item-icon>
                                <v-icon>
                                    mdi-pin
                                </v-icon>
                            </v-list-item-icon>
                             <p>A prediction platform developed with the best system that guarantees that you have at least 85% chance of winning.</p>
                        </v-list-item>
                        <v-list-item>
                            <v-list-item-icon>
                                <v-icon>
                                    mdi-pin
                                </v-icon>
                            </v-list-item-icon>
                             <p>We offer you the best customer service you will ever think of. This means that resolving your challenges is our top priority.</p>
                        </v-list-item>
                        <v-list-item>
                            <v-list-item-icon>
                                <v-icon>
                                    mdi-pin
                                </v-icon>
                            </v-list-item-icon>
                            <p>FREE offers for you even before signing up with us. You have access to certain predictions for just visiting our site - cool deal.</p>
                        </v-list-item>
                        <v-list-item>
                            <v-list-item-icon>
                                <v-icon>
                                    mdi-pin
                                </v-icon>
                            </v-list-item-icon>
                             <p>All our offers are simply created just for you.</p>
                        </v-list-item>
                    </v-list>
                    <p>As a lover of the sporting world who is keen on helping you break through the challenges of racking your heads around the best deals for the day, we are here to make your ride smooth and successful.

                    All you need to do is get started with us by clicking on the link below.</p>


                    <a align="center" style="display: flex; align-content: center; width: 100%;" target="_blank" href="http://betpro360.com">
                    <v-img style="margin: 0 auto;"  max-width="30%" :src="require('./sign-up.png')"></v-img></a>


                </v-col>
            </v-row>
        </v-container>
        <footer-component></footer-component>
    </div>
    
</template>

<script>
import HeaderComponent from './HeaderComponent'
import FooterComponent from './FooterComponent'
export default {
    metaInfo(){
        return{
            title: 'About Us',
            meta: [
                {
                    vmid: 'description',
                    name: 'description',
                    content: 'At BetPro360, we are here to offer you the best platform to successfully turn your passion for the game into a money-making activity. FREE offers for you even before signing up with us. You have access to certain predictions for just visiting our site - cool deal.'
                },
                {
                    vmid: 'author',
                    name: 'author',
                    content: 'Betpro360'                    
                }
            ],
        }
    },
    components: {
        'header-component': HeaderComponent,
        'footer-component': FooterComponent
    }
}
</script>

<style lang="css" scoped>
    p{
        font-family: serif;
        font-size: 120%;
    }
</style>
