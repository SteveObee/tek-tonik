<template>
  <div class="products-filter bg-white">
    <h4 class="mb-1">Brand</h4>
    <div v-for="brand in productBrands" class="filter-chkbox">
      <input v-bind:value="brand.id" type="checkbox" v-model="filteredBrands" />
      <label v-bind:for="brand.name">{{ brand.name }}</label>
    </div>

    <h4 class="my-1">Price</h4>
    <input v-bind:value="desc" type="radio" v-model="sortedPrice" id="desc" />
    <label for="desc">High to low</label>
    <br />
    <input v-bind:value="asc" type="radio" v-model="sortedPrice" id="asc" />
    <label for="asc">Low to high</label>
  </div>
</template>

<script>
export default {
  props: {
    productBrands: {
      type: Array
    }
  },
  data() {
    return {
      desc: "desc",
      asc: "asc",
      filteredBrands: [],
      sortedPrice: "desc"
    };
  }
};
</script>
