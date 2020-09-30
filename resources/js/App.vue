<template>
  <div id="page-wrapper">
    <div class="main-content mb-2">
      <div class="container">
        <Messages />
        <div class="my-2">
          <div>
            <StatusBar
              v-bind:user="user"
              v-bind:basket="basket"
              v-bind:total="total"
            />
          </div>

          <div id="main-bar" class="mb-3">
            <SearchBar />
            <Navbar v-bind:user="user" />
          </div>

          <div class="my-2">
            <Spinner v-if="loading" />
            <router-view v-else></router-view>
          </div>
        </div>
      </div>
    </div>
    <Footer />
  </div>
</template>
<script>
import StatusBar from "./views/layout/StatusBar";
import SearchBar from "./views/layout/SearchBar";
import Navbar from "./views/layout/Navbar";
import Footer from "./views/layout/Footer";
import Messages from "./views/layout/Messages";
import Spinner from "./views/Spinner";
import { mapState, mapActions } from "vuex";
import store from "./store/index";

export default {
  components: {
    SearchBar,
    Navbar,
    Footer,
    Messages,
    StatusBar,
    Spinner
  },
  async mounted() {
    (await this.user) && store.dispatch("getBasket", this.user.id);
  },
  computed: {
    ...mapState({
      auth: state => state.auth.isAuthenticated,
      loading: state => state.auth.loading,
      user: state => state.auth.user,
      basket: state => state.basket.basket,
      total: state => state.basket.total
    })
  }
};
</script>
