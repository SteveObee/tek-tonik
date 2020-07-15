<template>
  <div class="container">
    <div class="my-2">
      <div>
        <StatusBar />
      </div>
      <div>
        <Navbar />
      </div>
      <div class="my-2">
        <Spinner v-if="loading" />
        <router-view v-else></router-view>
      </div>
    </div>
  </div>
</template>
<script>
import StatusBar from "./views/layout/StatusBar";
import Navbar from "./views/layout/Navbar";
import Spinner from "./views/Spinner";
import { mapState, mapActions } from "vuex";
import store from "./store/index";

export default {
  components: {
    Navbar,
    StatusBar,
    Spinner
  },
  computed: {
    ...mapState({
      auth: state => state.auth.isAuthenticated,
      loading: state => state.auth.loading
    })
  },
  methods: {
    ...mapActions(["loadUser", "getBasket"])
  }
};
</script>
