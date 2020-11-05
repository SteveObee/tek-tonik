<template>
  <div class="product-item">
    <router-link :to="{ name: 'products.page', params: { id: product.id } }">
      <div class="image-container">
        <img :src="product.thumbnail" alt="Product Thumbnail" />
      </div>
    </router-link>
    <h4 v-if="product && productBrands">{{ brandName }}</h4>
    <h4>{{ product.name }} {{ product.model }}</h4>
    <h5>£{{ product.price }}</h5>
    <h5 v-if="product.stock > 0" class="mb-1" :class="stockClass">
      {{ product.stock }} in stock
    </h5>
    <h5 v-else class="mb-1" :class="stockClass">Out of stock</h5>
    <button
      @click.prevent="toggleModal"
      :disabled="!product.stock"
      class="btn-primary"
    >
      <i class="fas fa-plus"></i> Add to basket
    </button>
  </div>
</template>

<script>
import store from "../../store/index";
import { mapState } from "vuex";

export default {
  props: ["product"],
  computed: {
    ...mapState({
      productBrands: state => state.product.productBrands
    }),
    brandName: function() {
      let name;

      this.productBrands.forEach(brand => {
        if (brand.id === this.product.brand_id) {
          name = brand.name;
        }
      });

      return name;
    },
    stockClass() {
      return this.product.stock === 0
        ? "c-danger"
        : this.product.stock <= 10
        ? "c-warning"
        : "c-success";
    }
  },
  methods: {
    async toggleModal() {
      await store.dispatch("getProduct", this.product.id);
      store.commit("TOGGLE_MODAL");
    }
  }
};
</script>
