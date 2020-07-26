// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import { ValidationProvider, ValidationObserver, extend } from 'vee-validate'
import { required, email } from 'vee-validate/dist/rules'
import VueAxios from 'vue-axios'
import axios from '@/utils/Request.js'
import App from './App'
import router from './pages'
import * as Cookies from 'js-cookie'
import 'bulma/css/bulma.css'

import '@/assets/fonts/css/icons.css'

Vue.config.productionTip = false

const polyfill = (() => {
  // Object.entries
  if (!Object.entries)
  Object.entries = function( obj ){
    var ownProps = Object.keys( obj ),
    i = ownProps.length,
    resArray = new Array(i); // preallocate the Array
    while (i--)
    resArray[i] = [ownProps[i], obj[ownProps[i]]];

    return resArray;
  }
})();

// Vee-Validate configurations
extend('required', required)
extend('email', email)
Vue.component('ValidationObserver', ValidationObserver);
Vue.component('ValidationProvider', ValidationProvider);

Vue.use(VueAxios, axios)

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
