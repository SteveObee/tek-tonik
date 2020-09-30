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
    <h5 class="mb-1 c-success">{{ product.stock }} in stock</h5>
    <button class="btn-primary">
      <i class="fas fa-plus"></i> Add to basket
    </button>
  </div>
</template>

<script>
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
    }
  }
};
</script>
