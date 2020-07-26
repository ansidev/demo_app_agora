<template>
  <div class="user-list">
    <p style="color: #fff; margin: 5px;">User List</p>
    <table class="table is-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>UserID</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="user in users"
          :key="user.uid"
        >
          <td>{{ user.id }}</td>
          <td>{{ user.uid }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
export default {
  data() {
    return {
      users: [
        { id: 1, uid: "user_001" },
        { id: 2, uid: "user_002" },
        { id: 3, uid: "user_003" },
        { id: 4, uid: "user_004" },
        { id: 5, uid: "user_005" },
        { id: 6, uid: "user_006" }
      ]
    };
  }
};
</script>
<style>
.user-list {
  display: flex;
  flex-direction: column;
  align-items: center;
}
</style>
