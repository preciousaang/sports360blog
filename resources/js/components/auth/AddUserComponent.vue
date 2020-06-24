<template>
    <div>
        <header-component></header-component>
        <v-container>
            <v-card>
                <v-app-bar dark>
                    <v-toolbar-title>
                        Add User
                    </v-toolbar-title>
                </v-app-bar>
                <v-container>
                    <v-form @submit.prevent="addUser()">
                        <v-text-field :error-messages="emailErrors" @blur="$v.email.$touch()" v-model="email" label="E-mail"></v-text-field>
                        <v-text-field :error-messages="usernameErrors"  @blur="$v.username.$touch()" v-model="username" label="Username"></v-text-field>
                        <v-text-field :error-messages="nameErrors" v-model="name" @input="$v.name.$touch()" @blur="$v.name.$touch()" label="Name"></v-text-field>
                        <v-text-field :error-messages="passwordErrors" type="password" v-model="password" @input="$v.password.$touch()" @blur="$v.password.$touch()" label="Password"></v-text-field>
                        <v-text-field :error-messages="confirmPasswordErrors" type="password"@input="$v.confirm_password.$touch()" @blur="$v.confirm_password.$touch()" v-model="confirm_password" label="Confirm Password"></v-text-field>
                        <v-select :error-messages="roleErrors" v-model="role" @input="$v.role.$touch()" @blur="$v.role.$touch()" label="Role" item-text="full_name" item-value="id" :items="all_roles"></v-select>
                        <v-btn dense type="submit">
                            Create User
                        </v-btn>
                    </v-form>
                </v-container>

            </v-card>
        </v-container>

    </div>
</template>

<script>
import axios from 'axios';
import HeaderComponent from './AdminHeaderComponent'
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
                    axios.get('/user-by-email/'+value).then(res=>{
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
        role: {required, integer},
        name: {required},
        username: {
            required,
            alphaNum,
            minLength: minLength(3),
            maxLength: maxLength(15),
            isUnique(value){
                if(value==='') return true;

                return new Promise((resolve, reject)=>{
                    axios.get('/user-by-username/'+value).then(res=>{
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
            required,
            minLength: minLength(6),
            maxLength: maxLength(191)
        },
        confirm_password: {
            sameAs: sameAs('password')
        }

    },
    metaInfo: {
        title: 'Add User'
    },


    data(){
        return {
            email: null,
            name: null,
            username: null,
            password: null,
            confirm_password: null,
            role: null,
            all_roles: [],            
        }
    },
    components: {
        'header-component': HeaderComponent,
    },
    methods: {
        getRoles: function(){
            axios.get('/all-roles').then(res=>{
                this.all_roles = res.data;
            }).catch(err=>{
                swal({title: 'Server Error', icon: 'error'})
            })
        },
        addUser: function(){
            this.$v.$touch();
            if(this.$v.$invalid) return false;
            const data = {
                name: this.name,
                password: this.password,
                email: this.email,
                username: this.username,
                role: this.role
            }
            axios.post('/add-user', data).then(res=>{
                console.log(res);
                swal({title: 'User Added Successfully', icon: 'success'});
                this.$router.push({name: 'manage-users'});

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
            !this.$v.password.required && errors.push('Password is required');
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
        roleErrors(){
            const errors = [];
            if(!this.$v.role.$dirty) return errors;
            !this.$v.role.required && errors.push('A role is required');
            !this.$v.role.integer && errors.push('This role must be an integer');
            return errors
        }
    },
    mounted(){
        this.getRoles();
    }
}
</script>

<style lang="css" scoped>
</style>
