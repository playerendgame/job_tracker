<template>
    <div>
        <div class="container pt-5">
            <div class="credential-row p-5">
                <div class="login-label">
                    <span class="h4">Login</span>
                </div>
                <div class="email-input pt-4">
                    <input class="form-control" type="email" placeholder="Enter Email" v-model="email">
                </div>
                <div class="password-input pt-4">
                    <input class="form-control" type="password" placeholder="Enter Password" v-model="password">
                </div>
                <div class="buttons d-flex justify-content-center pt-4">
                    <button class="btn btn-success" @click="loginUser()">Log In</button>
                    &nbsp; &nbsp;
                    <button class="btn btn-primary" @click="$bvModal.show('register-modal')">Sign Up</button>
                    <register-component />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Swal from 'sweetalert2';
import axios from 'axios';

export default {
  data() {
    return {
      email: '',
      password: '',
    };
  },
  methods: {
    loginUser() {
      axios.post('/login', {
        email: this.email,
        password: this.password,
      })
      .then(response => {
            if (response.data.message === 'Login successful') {
                
                window.location.href = '/dashboard';
            } else {
                Swal.fire({
                icon: 'error',
                title: 'Login Failed',
                text: response.data.message,
                });
            }
            })
            .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Login Failed',
                text: error.response.data.message,
            });
        })
      .catch(error => {
        console.error(error);
      });
    },
  },
};
</script>


<style>
.credential-row {
    border: 2px solid rgb(209, 209, 209);
    padding: 20px;
    box-shadow: 5px 5px 5px 5px rgb(231, 231, 231);
    border-radius: 25px;
    width: 50%;
    margin: 40px auto; /* add this to center the element horizontally */
    position: relative; /* add this to center the element vertically */
    top: 50%; /* add this to center the element vertically */

}
</style>
