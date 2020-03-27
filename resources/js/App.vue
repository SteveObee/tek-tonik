<template>
  <div>
    <h1>Ecommerce app</h1>
    <p>
      <router-link :to="{ name: 'dashboard' }">Dashboard</router-link> |
      <router-link :to="{ name: 'users' }">Users</router-link> |
      <router-link :to="{ name: 'users.create' }">Create User</router-link>
    </p>
    <div class="container">
      <router-view></router-view>
    </div>
  </div>
</template>
<script>
export default {};
</script>
