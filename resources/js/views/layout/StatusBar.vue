<template>
  <div id="status-bar">
    <router-link
      :to="{ name: 'basket' }"
      v-if="basketItemCount || basketItemCount == 0"
      ><i class="fas fa-shopping-cart"></i> ( {{ basketItemCount }} / £{{
        total ? total : "0"
      }}
      )</router-link
    >
    <router-link :to="{ name: 'dashboard.profile' }" v-if="user"
      ><i class="fas fa-user"></i> Welcome, {{ user.name[0] }}</router-link
    >
    <router-link :to="{ name: 'login' }" v-else
      ><i class="fas fa-user"></i> Sign in | Register</router-link
    >
    <a v-if="user" @click="logout"
      ><i class="fas fa-sign-out-alt"></i> Logout</a
    >
  </div>
</template>

<script>
import { mapActions, mapState } from "vuex";
import store from "../../store/index";

export default {
  props: {
    user: {
      type: Object
    },
    basket: {
      type: Array
    },
    total: {
      type: String
    }
  },
  mounted() {},
  name: "StatusBar",
  computed: {
    basketItemCount() {
      return this.basket ? Object.keys(this.basket).length : 0;
    }
  },
  methods: {
    async logout() {
      await store.dispatch("logoutUser");

      if (!this.user) {
        this.$router.push({
          name: "login"
        });
      }
    }
  }
};
</script>
