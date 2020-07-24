import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

const router = new Router({
  mode: 'history',
  base: 'http://localhost:8080',
  routes: [{
    path: '',
    component: () =>
      import ('./layouts/main/Main.vue'),
    children: [{
        path: '/',
        redirect: '/login',
      }, {
        path: '/home',
        name: 'home',
        component: () =>
          import ('./views/Home.vue'),
        meta: {
          authRequired: 'true',
        }
      },

      {
        path: '/login',
        name: 'login',
        props: true,
        component: () =>
          import ('@/views/Login.vue'),
        meta: {
          authRequired: 'false',
        },
      },

      {
        path: '/permissions',
        name: 'permissions',
        props: true,
        component: () =>
          import ('@/views/Permissions.vue'),
        meta: {
          authRequired: 'true',
        },
      },

      {
        path: '/roles',
        name: 'roles',
        props: true,
        component: () =>
          import ('@/views/Roles.vue'),
        meta: {
          authRequired: 'true',
        },
      },

      {
        path: '/users',
        name: 'users',
        props: true,
        component: () =>
          import ('@/views/Users.vue'),
        meta: {
          authRequired: 'true',
        },
      },

     {
        path: '/not-authorized',
        name: 'not-authorized',
        props: true,
        component: () =>
          import ('@/views/NotAuthorized.vue'),
        meta: {
          authRequired: 'false',
        },
      },

    ],
  }]
});

router.beforeEach((to, from, next) => {

  //A Logged-in user can't go to login page again
  if (to.name === 'login' && localStorage.getItem("accessToken")) {
    router.push({
      name: 'home'
    })

    //the route requires authentication
  } else if (to.meta.authRequired) {

    if (!localStorage.getItem("accessToken")) {

      //user not logged in, send them to login page
      router.push({
        name: 'login',
        query: {
          to: to.name
        }
      })

    } else {
      if (!this.hasAccess(to.name)) {
        router.push({
          name: 'page-not-authorized'
        })
      }
    }
  }

  return next()
});

hasAccess(name) {
  permissions = localStorage.getItem("permissions");

  switch (name) {

    case "home":
      return true;

    case "users":
      return permissions.includes("View All Users")

    case "permissions":
      return permissions.includes("View All Permissions")

    case "roles":
      return permissions.includes("View All Roles")

    default:
      return false;
  }
}

