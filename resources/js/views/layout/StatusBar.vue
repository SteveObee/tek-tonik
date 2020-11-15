<template>
  <div id="status-bar">
    <router-link class="status-bar-logo" :to="{ name: 'products.index' }">
      <img src="/storage/logo.png" alt="" />
    </router-link>
    <div class="status-bar-right">
      <router-link
        :to="{ name: 'basket' }"
        :class="[
          currentPath.includes('basket') ? 'router-link-active-status' : ''
        ]"
        v-if="basketItemCount || basketItemCount == 0"
        ><i class="fas fa-shopping-cart"></i> ( {{ basketItemCount }} / £{{
          total ? totalFixed : "0"
        }}

        )
      </router-link>
      <router-link
        :to="{ name: 'dashboard.profile' }"
        v-if="user"
        class="profile-link"
        ><i class="fas fa-user"></i> Welcome, {{ user.name }}</router-link
      >
      <a v-if="auth" @click="logout"
        ><i class="fas fa-sign-out-alt"></i> Logout</a
      >
      <router-link :to="{ name: 'login' }" v-else
        ><i class="fas fa-sign-in-alt"></i> Sign in</router-link
      >
    </div>
  </div>
</template>

<script>
import { mapActions, mapState } from "vuex";
import store from "../../store/index";

export default {
  props: {
    auth: {
      type: Boolean
    },
    user: {
      type: Object
    },
    basket: {
      type: Array
    },
    total: {
      type: Number
    }
  },
  mounted() {},
  name: "StatusBar",
  computed: {
    basketItemCount() {
      return this.basket ? Object.keys(this.basket).length : 0;
    },
    totalFixed() {
      return this.total.toFixed(2);
    },
    currentPath() {
      return this.$route.path;
    }
    /* statusBarStyle() {
      return this.currentRoute.name === "basket"
        ? { "border-bottom": "2px solid #1cb7ff;" }
        : null;
    } */
  },
  methods: {
    async logout() {
      await store.dispatch("logoutUser");
      await store.dispatch("emptyBasket", { userId: "Guest" });
      await store.dispatch("getBasket", this.user.id);

      if (!this.auth) {
        this.$router.push({
          name: "login"
        });
      }
    }
  }
};
</script>
