<template>
   <b-modal id="register-modal" title="Register" hide-footer hide-header>
        <div class="row">
            <div class="name-input">
                <input class="form-control" type="text" placeholder="Enter Name" v-model="name">
            </div>
            <div class="email-input pt-4">
                <input class="form-control" type="email" placeholder="Enter Email" v-model="email">
            </div>
            <div class="password-input pt-4">
                <input class="form-control" type="password" placeholder="Enter Password" v-model="password">
            </div>
            <div class="confirmPassword-input pt-4">
                <input class="form-control" type="password" placeholder="Confirm Password" v-model="confirmPassword">
            </div>
            <div class="buttons pt-4">
                <button class="btn btn-success" @click.prevent="submitForm">Sign In</button>
            </div>
        </div>
    </b-modal>
</template>

<script>
import Swal from 'sweetalert2';
import axios from 'axios';
export default {

    data(){
        return{
            name: '',
            email: '',
            password: '',
            confirmPassword: ''
        }
    },
    methods: {
        submitForm(){
            if (this.password !== this.confirmPassword){
                Swal.fire({
                    title: 'Error!',
                    text: 'Password and confrm password do not match!',
                    icon: 'error',
                    confirmButtonText: 'Okay'
                })
                return
            }
            axios.post('/register', {
                name: this.name,
                email: this.email,
                password: this.password,
                password_confirmation: this.confirmPassword
            })
            .then(response => {
                Swal.fire({
                    title: 'Success!',
                    text: 'You have successfully registered',
                    icon: 'success',
                    confirmButtonText: 'Okay'
                })
                this.name = ''
                this.email = ''
                this.password = ''
                this.confirmPassword = ''
            })
            .catch(error => {
                Swal.fire({
                title: 'Error!',
                text: 'Registration failed. Please try again.',
                icon: 'error',
                confirmButtonText: 'Okay'
                })
            })
        }
    }


}
</script>
