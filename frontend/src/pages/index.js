import Vue from 'vue'
import Router from 'vue-router'
import Home from './Home'
import Meeting from './Meeting'
import Screen from './Screen'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Home',
      component: Home
    },
    {
      path: '/meeting',
      name: 'Meeting',
      component: Meeting
    },
    {
      path: '/screen',
      name: 'Screen',
      component: Screen
    }
  ]
})
