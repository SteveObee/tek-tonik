<template>
  <nav id="main-nav">
    <router-link class="nav-link" :to="{ name: 'dashboard.profile' }"
      >Home</router-link
    >
    <router-link class="nav-link" :to="{ name: 'products.index' }"
      >Products</router-link
    >
    <router-link class="nav-link" :to="{ name: 'users.create' }"
      >About</router-link
    >
    <router-link class="nav-link" :to="{ name: 'users.create' }"
      >Contact</router-link
    >
  </nav>
</template>

<script>
export default {};
</script>
