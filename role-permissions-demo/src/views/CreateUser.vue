<template>
  <div>
    <div v-if="canCreateUsers">
      <button :disabled="!validateForm" @click="createUser">Create User</button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      permissions: localStorage.getItem("permissions"),
    }
  },
  computed: {
    canCreateUsers() {
      return  this.permissions.includes("View All Users")
    },
  },
  methods: {
    createUser() {
      //user creation logic
    }
  }
}
</script>