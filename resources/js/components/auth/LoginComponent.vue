<template>
    <div>
        <v-container>
            <v-row :align="'center'" :justify="'center'" no-gutters>
                <v-col lg="5" md="6" sm="8" xs="8">
                    <v-card outlined>
                        <v-toolbar dark>
                            <v-toolbar-title>Login</v-toolbar-title>
                        </v-toolbar>
                        <v-container>
                            <v-alert dismissible v-model="error" type="error" dense>Username/Password Combo Incorrect</v-alert>
                            <v-form @submit.prevent="login()">
                                <v-text-field :error-messages="usernameError" @input="$v.username.$touch()" @blur="$v.username.$touch()" v-model="username" label="Username" prepend-icon="mdi-account"></v-text-field>
                                <v-text-field :error-messages="passwordError" @input="$v.password.$touch()" @blur="$v.password.$touch()" v-model="password" type="password" label="Password" prepend-icon="mdi-lock"></v-text-field>
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
    import {validationMixin} from 'vuelidate';
    import {required} from 'vuelidate/lib/validators';
    export default{
        data(){
            return {
                error: false,
                username: null,
                password: null
            }
        },
        mixins: [validationMixin],
        validations: {
            username: {required},
            password: {required}
        },
        computed: {
            usernameError(){
                const errors=[];
                if(!this.$v.username.$dirty) return errors;
                !this.$v.username.required && errors.push('Username is required');
                return errors;
            },
            passwordError(){
                const errors=[];
                if(!this.$v.password.$dirty) return errors;
                !this.$v.password.required && errors.push('Password is required');
                return errors;
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
                this.$v.$touch();
                if(this.$v.$invalid) return false;
                const data = {
                    username: this.username,
                    password: this.password
                };
                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios.post('/login', data).then(response=>{
                        this.error=null;
                        this.$router.push('/admin');
                    }).catch(error=>{
                        this.error = true;
                    })
                });
            }
        },
    }
</script>

<style>

</style>
