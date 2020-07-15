<template>
  <div id="status-bar">
    <router-link
      :to="{ name: 'basket' }"
      v-if="basketItemCount || basketItemCount == 0"
      ><i class="fas fa-shopping-cart"></i> ({{ basketItemCount }})</router-link
    >
    <router-link :to="{ name: 'dashboard.profile' }" v-if="user"
      ><i class="fas fa-user"></i> Welcome, {{ user.name[0] }}</router-link
    >
    <router-link :to="{ name: 'login' }" v-else
      ><i class="fas fa-user"></i> Sign in | Register</router-link
    >
    <a v-if="user" v-on:click="logout"
      ><i class="fas fa-sign-out-alt"></i> Logout</a
    >
  </div>
</template>

<script>
import { mapActions, mapState } from "vuex";
import store from "../../store/index";

export default {
  mounted() {
    if (this.user) {
      store.dispatch("getBasket", this.user.id);
    }
  },
  name: "StatusBar",
  computed: {
    ...mapState({
      user: state => state.auth.user,
      basket: state => state.basket.basket
    }),
    basketItemCount() {
      if (this.basket) {
        return Object.keys(this.basket).length;
      } else {
        return 0;
      }
    }
  },
  methods: {
    async logout(event) {
      await store.dispatch("logoutUser");
      await store.dispatch("emptyBasket");

      if (!this.$store.state.auth.isAuthenticated) {
        this.$router.push({
          name: "login"
        });
      }
    }
  }
};
</script>
