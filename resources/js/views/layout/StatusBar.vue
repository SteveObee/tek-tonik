<template>
  <div id="status-bar">
    <router-link :to="{ name: 'dashboard.profile' }"
      ><i class="fas fa-user"></i> Welcome, {{ name[0] }}</router-link
    >
    <a v-on:click="logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </div>
</template>

<script>
import { mapActions, mapState } from "vuex";
import store from "../../store/index";

export default {
  name: "StatusBar",
  props: {
    name: String
  },
  methods: {
    async logout(event) {
      await store.dispatch("logoutUser");

      if (!this.$store.state.auth.isAuthenticated) {
        this.$router.push({
          name: "login"
        });
      }
    }
  }
};
</script>
