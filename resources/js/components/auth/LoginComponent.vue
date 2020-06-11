<template>
    <div>
        <v-container>
            <v-row :align="'center'" :justify="'center'" no-gutters>
                <v-col :cols="'5'">
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
        methods: {
            login: function(){
                const data = {
                    username: this.username,
                    password: this.password
                };
                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios.post('/login', data).then(response=>{
                        this.$router.push('/dashboard');
                    }).catch(error=>{
                        console.log(error.response);
                    })
                });
            }
        },
        beforeRouteEnter(to, from , next){
            axios.get('/user').then(response=>{
                if(response.status===200){
                    next('/dashboard');
                }
            }).catch(err=>{
                next();
            });
        }
    }
</script>

<style>

</style>
