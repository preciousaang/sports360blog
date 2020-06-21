<template>
    <div>
        <v-container>
            <v-row>
                <v-col cols="12">
                    <v-form @submit.prevent="uploadFile()">
                        <v-file-input :error-messages="imageErrors" accept="image/*" @input="$v.image.$touch()"  @blur="$v.image.$touch()" label="Add Image" ref="files" v-model="image"></v-file-input>
                        <v-btn :disabled="$v.$invalid" class="ml-5" block type="submit">Upload</v-btn>                        
                    </v-form>
                </v-col>
            </v-row>
            
        </v-container>
    </div>
    
</template>

<script>
    import {validationMixin} from 'vuelidate'; 
    import {required} from 'vuelidate/lib/validators';
    import axios from 'axios';
    export default{
        mixins: [validationMixin],
        validations: {
            image: {required},
        },
        computed: {
            imageErrors: function(){
                const errors = [];
                if(!this.$v.image.$dirty) return errors;
                !this.$v.image.required && errors.push('Image is required');
                return errors;
            }
        },
        data(){
            return {
                image: null,                
            }
        },
        methods: {
            uploadFile(){
                this.$v.$touch();
                if(this.$v.$invalid) return false;
                const formData = new FormData();
                formData.append('image', this.$refs.files.value);
                axios.post('/upload-image', formData).then(res=>{
                    this.$refs.files.value = null;
                    this.$v.$reset();
                    this.image = null;
                    this.$emit('select-file', {src: res.data});
                    console.log(res.data);
                }).catch(err=>{
                    console.log(err.response);
                })
            }
        }
    }
</script>

<style scoped>

<style>