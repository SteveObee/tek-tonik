<template>
  <div class="product-item">
    <router-link :to="{ name: 'products.page', params: { id: product.id } }">
      <div class="image-container">
        <img :src="product.thumbnail" alt="Product Thumbnail" />
      </div>
    </router-link>
    <h4>{{ product.name }} {{ product.model }}</h4>
    <h5>£{{ product.price }}</h5>
    <h5 class="mb-1 c-success">{{ product.stock }} in stock</h5>
    <button class="btn-primary">
      <i class="fas fa-plus"></i> Add to basket
    </button>
  </div>
</template>

<script>
export default {
  props: ["product"]
};
</script>
