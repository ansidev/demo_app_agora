<template>
  <div>
    <input name="email" label="Login ID" v-model="email" />
    <span class="text-danger text-sm">{{ errors.first('email') }}</span>
    <inpu type="password" name="password" label="Password" v-model="password" />
    <span class="text-danger text-sm">{{ errors.first('password') }}</span>
    <div class="flex flex-wrap justify-between my-10">
      <button :disabled="!validateForm" @click="login">Login</button>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      email: '',
      password: '',
    }
  },
  computed: {
    //check if both password and email have been set for enabling login button
    validateForm() {
      return this.email != '' && this.password != '';
    },
  },
  methods: {

    login() {

      const payload = {
        email: this.email,
        password: this.password
      }

      //post credentials and get access token from laravel backend
      axios.post('http://localhost:8000/login', payload)
        .then(() => {

          //we store the access token in localstorage, so that we can use it again.
          localStorage.setItem("accessToken", response.data.access_token);

          //we also store the user permissions in localstore.
          //This is needed to implement access control.
          localStorage.setItem("userPermissions", response.data.permissions);

          //after storing token, send user to home page.
          this.$router.push('/home');

        })
        .catch(error => {
          console.log(error)
        })
    }
  }
}
</script>
