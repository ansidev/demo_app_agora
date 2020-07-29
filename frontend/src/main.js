import Vue from 'vue'
import { ValidationProvider, ValidationObserver, extend } from 'vee-validate'
import { required, email } from 'vee-validate/dist/rules'
import VueAxios from 'vue-axios'
import axios from './utils/Request.js'
import App from './App.vue'
import router from './router'
/* eslint-disable no-unused-vars */
import * as Cookies from 'js-cookie'
import 'bulma/css/bulma.css'
import '@/assets/fonts/css/icons.css'

Vue.config.productionTip = false

// Vee-Validate configurations
extend('required', required)
extend('email', email)
Vue.component('ValidationObserver', ValidationObserver);
Vue.component('ValidationProvider', ValidationProvider);

Vue.use(VueAxios, axios)

new Vue({
  router,
  render: h => h(App)
}).$mount('#app')
