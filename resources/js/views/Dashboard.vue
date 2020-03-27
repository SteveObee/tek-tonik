<template>
  <div>
    <h2>Dashboard</h2>
    <button v-on:click="increment()">
      you have clicked {{ count }} times!
    </button>
    <button v-on:click="toggleAuth()">Auth</button>
    <p v-if="isAuthenticated">Authenticated!!!</p>
  </div>
</template>

<script>
import { mapActions } from "vuex";

export default {
  name: "Dashboard",
  computed: {
    count() {
      return this.$store.state.dashboard.count;
    },
    isAuthenticated() {
      return this.$store.state.dashboard.isAuthenticated;
    }
  },
  methods: {
    ...mapActions(["increment"]),
    ...mapActions(["toggleAuth"])
  }
};
</script>
