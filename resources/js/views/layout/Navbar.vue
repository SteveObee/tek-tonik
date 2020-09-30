<template>
  <nav>
    <router-link class="nav-link" :to="{ name: 'products.index' }"
      >Products</router-link
    >
    <router-link class="nav-link" :to="{ name: 'contact' }"
      >Contact</router-link
    >
    <router-link
      :class="[
        currentPath.includes('dashboard') ? 'router-link-active' : '',
        'nav-link'
      ]"
      :to="accountTo"
      >Account</router-link
    >
  </nav>
</template>

<script>
import SearchBar from "./SearchBar";

export default {
  props: {
    user: {
      type: Object
    }
  },
  computed: {
    accountTo() {
      return this.user ? { name: "dashboard.profile" } : { name: "register" };
    },
    currentPath() {
      return this.$route.path;
    }
  }
};
</script>
