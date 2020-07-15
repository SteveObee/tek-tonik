<template>
  <div v-if="products" id="products">
    <Sidebar />

    <div>
      <h1 class="section-title">Phones</h1>
      <div class="bottom-line"></div>
      <div class="products-content">
        <div v-for="product in products">
          <ProductItem :product="product" />
        </div>
      </div>
    </div>
  </div>
  <div v-else>
    <h3>No products found</h3>
  </div>
</template>

<script>
import { mapState, mapActions } from "vuex";
import store from "../../store/index";
import Sidebar from "../layout/Sidebar";
import ProductItem from "./ProductItem";
import Spinner from "../Spinner";

export default {
  name: "Products",
  components: {
    Sidebar,
    ProductItem
  },
  async beforeRouteEnter(to, from, next) {
    try {
      await store.dispatch("getAllProducts");
      next();
    } catch (e) {
      next({
        name: "users"
      });
    }
  },
  computed: {
    ...mapState({
      products: state => state.product.products,
      loading: state => state.product.loading
    })
  },
  methods: {
    ...mapActions(["getAllProducts"])
  }
};
</script>
