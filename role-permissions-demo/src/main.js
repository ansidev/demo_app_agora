import Vue from 'vue'
import App from './App.vue'
import routes from './routes'


Vue.config.productionTip = false

new Vue({
  render: h => h(App),
}).$mount('#app')
