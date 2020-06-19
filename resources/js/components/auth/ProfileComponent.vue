<template>
    <div>
        <v-container>
            <v-card>
                <v-app-bar dark>
                    <v-toolbar-title>
                        Edit Your Profile
                    </v-toolbar-title>
                </v-app-bar>
                <v-container>
                    <v-form @submit.prevent="editUser()">
                        <v-text-field :error-messages="emailErrors" @blur="$v.email.$touch()" v-model="email" label="E-mail"></v-text-field>
                        <v-text-field :error-messages="usernameErrors"  @blur="$v.username.$touch()" v-model="username" label="Username"></v-text-field>
                        <v-text-field :error-messages="nameErrors" v-model="name" @input="$v.name.$touch()" @blur="$v.name.$touch()" label="Name"></v-text-field>
                        <v-text-field :error-messages="passwordErrors" type="password" v-model="password" @input="$v.password.$touch()" @blur="$v.password.$touch()" label="Password"></v-text-field>
                        <v-text-field :error-messages="confirmPasswordErrors" type="password"@input="$v.confirm_password.$touch()" @blur="$v.confirm_password.$touch()" v-model="confirm_password" label="Confirm Password"></v-text-field>
                        <v-btn dense type="submit">
                            Update Your Account
                        </v-btn>
                    </v-form>
                </v-container>

            </v-card>
        </v-container>

    </div>
</template>

<script>
import axios from 'axios';
import {validationMixin} from 'vuelidate';
import {required, minLength, maxLength, sameAs, integer, email, alphaNum} from 'vuelidate/lib/validators';
export default {
    mixins: [
        validationMixin,
    ],
    validations: {
        email: {
            required,
            email,
            isUnique(value){
                if(value==='') return true;
                return new Promise((resolve, reject)=>{
                    axios.post('/user-by-email?id='+this.user.id, {email: value}).then(res=>{
                        if(res.data.email){
                            resolve(false);
                        }else{
                            resolve(true);
                        }
                    }).catch(err=>{
                        console.log(err.response);
                    })
                });
            }
        },
        name: {required},
        username: {
            required,
            alphaNum,
            minLength: minLength(3),
            maxLength: maxLength(15),
            isUnique(value){
                if(value==='') return true;

                return new Promise((resolve, reject)=>{
                    axios.post('/user-by-username?id='+this.user.id, {username: value}).then(res=>{
                        if(res.data.username){
                            resolve(false);
                        }else{
                            resolve(true);
                        }
                    }).catch(err=>{
                        console.log(err.response);
                    })
                });
            }
        },
        password: {
            minLength: minLength(6),
            maxLength: maxLength(191)
        },
        confirm_password: {
            sameAs: sameAs('password')
        }

    },
    metaInfo: {
        title: 'Edit User'
    },


    data(){
        return {
            email: null,
            user: null,
            name: null,
            username: null,
            password: null,
            confirm_password: null,

        }
    },
    methods: {
        getUser: function(id){
            axios.get('/auth-user/').then(res=>{
                this.user = res.data;
                this.name = this.user.name;
                this.username = this.user.username;
                this.role = this.user.role_id;
                this.email = this.user.email;
            }).catch(err=>{console.log(err.response)});
        },
        editUser: function(){
            this.$v.$touch();
            if(this.$v.$invalid) return false;
            const data = {
                name: this.name,
                password: this.password,
                email: this.email,
                username: this.username,
                role: this.role
            }
            axios.put('/user/'+this.user.id, data).then(res=>{
                this.password=this.confirm_password=null;
                this.$v.$reset();
                swal({title: 'User Updated Successfully', icon: 'success'});

            }).catch(err=>{
                console.log(err.response);
                swal({title: 'Server Error', text: 'Try again', icon: 'error'});
            });
        }
    },
    computed: {
        nameErrors(){
            const errors = [];
            if(!this.$v.name.$dirty) return errors;
            !this.$v.name.required && errors.push('A name is required');
            return errors;
        },
        passwordErrors(){
            const errors = [];
            if(!this.$v.password.$dirty) return errors;
            !this.$v.password.minLength && errors.push('Minimum of 6 characters')
            !this.$v.password.maxLength && errors.push('Maximum of 191 characters');
            return errors;
        },
        confirmPasswordErrors(){
            const errors = [];
            if(!this.$v.confirm_password.$dirty) return errors;
            !this.$v.confirm_password.sameAs && errors.push('Must be equal to password');
            return errors;
        },
        usernameErrors(){
            const errors = [];
            if(!this.$v.username.$dirty) return errors;
            !this.$v.username.required && errors.push('Username is required');
            !this.$v.username.isUnique && errors.push('This username is already taken');
            !this.$v.username.minLength && errors.push('Minimum of 3 characters');
            !this.$v.username.maxLength && errors.push('Maximum of 15 characters');
            !this.$v.username.alphaNum && errors.push('Letters and numbers only without spaces.');
            return errors;
        },
        emailErrors(){
            const errors = [];
            if(!this.$v.email.$dirty) return errors;
            !this.$v.email.required && errors.push('Email is required');
            !this.$v.email.email && errors.push('Must be a valid e-mail');
            !this.$v.email.isUnique && errors.push('This e-mail is already taken');
            return errors;
        },
    },
    mounted(){        
        this.getUser(this.$route.params.id);
    }
}

</script>

<style lang="css" scoped>
</style>
