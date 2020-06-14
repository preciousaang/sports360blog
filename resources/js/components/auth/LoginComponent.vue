<template>
    <div>
        <v-container>
            <v-row :align="'center'" :justify="'center'" no-gutters>
                <v-col lg="5" md="10" sm="10" xs="10">
                    <v-card outlined>
                        <v-toolbar dark>
                            <v-toolbar-title>Login</v-toolbar-title>
                        </v-toolbar>
                        <v-container>
                            <v-form @submit.prevent="login()">
                                <v-text-field v-model="username" label="Username" prepend-icon="mdi-account"></v-text-field>
                                <v-text-field v-model="password" type="password" label="Password" prepend-icon="mdi-lock"></v-text-field>
                                <v-btn class="ml-7" type="submit">
                                    Login
                                </v-btn>
                            </v-form>
                        </v-container>

                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>

<script>
    import axios from 'axios';
    export default{
        data(){
            return {
                username: null,
                password: null
            }
        },
        metaInfo: {

            title: 'Login',
            meta: [
                {
                    name: 'description',
                    content: 'Login to manage posts in Bet pro 360'
                }
            ]

        },
        methods: {
            login: function(){
                const data = {
                    username: this.username,
                    password: this.password
                };
                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios.post('/login', data).then(response=>{
                        this.$router.push('/admin');
                    }).catch(error=>{
                        console.log(error.response);
                    })
                });
            }
        },
    }
</script>

<style>

</style>
