<template>
  <div id="page-wrapper">
    <Modal v-if="modalVisible">
      <AddressForm v-if="modalComponent === 'AddressForm'" />
      <ProductItemModal v-else-if="modalComponent === 'ProductItemModal'" />
      <div v-else-if="modalComponent === 'Menu'" class="px-2">
        <h4 class="mb-2">Select Category:</h4>
        <Menu
          v-bind:sub_categories="recursedCategories"
          name="All Products"
          :id="1"
          :depth="0"
          class="mb-2"
        />
      </div>
    </Modal>
    <div class="main-content main-content-bg">
      <div class="container ">
        <Messages />
        <div class="my-2">
          <div>
            <StatusBar
              v-bind:auth="auth"
              v-bind:user="user"
              v-bind:basket="basket"
              v-bind:total="total"
            />
          </div>

          <div id="main-bar" :class="mainBarClass">
            <SearchBar class="bg-white" v-if="displaySearchBar" />
            <Navbar v-bind:auth="auth" v-bind:user="user" />
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
import AddressForm from "./views/dashboard/AddressForm";
import ProductItemModal from "./views/products/ProductItemModal";
import Navbar from "./views/layout/Navbar";
import Footer from "./views/layout/Footer";
import Menu from "./views/layout/Menu";
import Messages from "./views/layout/Messages";
import Spinner from "./views/Spinner";
import Modal from "./views/layout/Modal";
import { mapState, mapActions } from "vuex";
import store from "./store/index";

export default {
  data() {
    return {};
  },
  components: {
    StatusBar,
    SearchBar,
    AddressForm,
    ProductItemModal,
    Navbar,
    Footer,
    Menu,
    Messages,
    Spinner,
    Modal
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
      total: state => state.basket.total,
      modalVisible: state => state.layout.modalVisible,
      modalComponent: state => state.layout.modalComponent,
      recursedCategories: state => state.category.recursedCategories
    }),
    displaySearchBar() {
      return this.$route.name && this.$route.name === "products.index"
        ? true
        : false;
    },
    mainBarClass() {
      return this.displaySearchBar ? "main-with-search" : "main-without-search";
    }
  }
};
</script>
