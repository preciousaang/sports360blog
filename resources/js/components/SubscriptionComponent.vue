<template>
    <div>
        <v-form @submit.prevent="subscribe()" class="mb-6">
            <v-text-field @blur="$v.newsletter.$touch()" :error-messages="newsletterErrors" v-model="newsletter" placeholder="Subscribe to our Newsletter"></v-text-field>
            <v-btn dense :disabled="$v.newsletter.$invalid" block type="submit">Subscribe</v-btn>
        </v-form>
    </div>
</template>
<script>
import {validationMixin} from 'vuelidate';
import {required, email} from 'vuelidate/lib/validators';
import axios from 'axios'
import swal from 'sweetalert';
export default{
    data(){
        return {
            newsletter: null,
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
        subscribe(){
            this.$v.newsletter.$touch();
            if(this.$v.newsletter.$invalid) return false;       
            axios.post('add-subscriber', {subscriber: this.newsletter}).then(res=>{
                swal({title: 'Thank You for subscribing', icon: 'success'});
                this.newsletter = null;                
                this.$v.$reset();
            }).catch(err=>{
                console.log(err.response);
            })
        }
    }
}
</script>