<template>
  <div v-if="loading" class="products-spinner">
    <Spinner />
  </div>
  <div id="products-page" v-else-if="categoryProducts">
    <div class="products-left">
      <Menu
        v-bind:sub_categories="recursedCategories"
        name="All Products"
        :id="1"
        :depth="0"
        class="products-menu mb-2"
      />

      <div class="products-filter bg-white">
        <h4 class="mb-1">Brand</h4>
        <div v-for="brand in productBrands" class="filter-chkbox">
          <input
            v-bind:value="brand.id"
            type="checkbox"
            v-model="filteredBrands"
          />
          <label v-bind:for="brand.name">{{ brand.name }}</label>
        </div>

        <h4 class="my-1">Price</h4>
        <input
          v-bind:value="desc"
          type="radio"
          v-model="sortedPrice"
          id="desc"
        />
        <label for="desc">High to low</label>
        <br />
        <input v-bind:value="asc" type="radio" v-model="sortedPrice" id="asc" />
        <label for="asc">Low to high</label>
      </div>
    </div>

    <div v-if="categoryProducts.length > 0" class="products-center">
      <div class="mb-1 products-results c-grey-50">
        <div v-if="searchQuery">
          <p>Searched for "{{ searchQuery }}" in {{ selectedCategory.name }}</p>
        </div>
        <div v-if="filteredBrands.length > 0">
          <p>
            Filtering products from{{ " " }}
            <span v-for="brand in filteredBrands">
              {{ productBrands[brand - 1].name }}
            </span>
          </p>
        </div>
      </div>

      <div v-for="id in recursiveIds" :key="id" class="mb-1">
        <Products
          v-bind:categoryId="id"
          v-bind:categories="categories"
          v-bind:filteredBrands="filteredBrands"
          v-bind:sortedPrice="sortedPrice"
          v-bind:recursiveIds="recursiveIds"
          v-bind:products="categoryProducts"
          class="bg-white"
        />
      </div>
    </div>

    <div v-else>
      <div class="mb-1 products-results c-grey-50">
        <div v-if="searchQuery">
          <p>Searched for "{{ searchQuery }}" in {{ selectedCategory.name }}</p>
        </div>
        <div v-if="filteredBrands.length > 0">
          <p>
            Filtering products from{{ " " }}
            <span v-for="brand in filteredBrands">
              {{ productBrands[brand - 1].name }}
            </span>
          </p>
        </div>
      </div>

      <h4 class="">No products found</h4>
    </div>
  </div>
</template>

<script>
import { mapState, mapActions } from "vuex";
import { search } from "../../utils/helpers";
import store from "../../store/index";
import Menu from "../layout/Menu";
import ProductItem from "./ProductItem";
import ProductsFilter from "./ProductsFilter";
import Products from "./Products";
import Spinner from "../Spinner";

export default {
  name: "ProductsPage",
  components: {
    Menu,
    Products,
    ProductsFilter,
    Spinner
  },
  data() {
    return {
      desc: "desc",
      asc: "asc",
      filteredBrands: [],
      sortedPrice: "desc",
      prevRoute: null
    };
  },
  async mounted() {
    await store.dispatch("getRecursiveCategoryIds", this.selectedCategory.id);

    if (this.recursiveIds.length > 1) {
      await store.dispatch("getAllProducts", {
        category_ids: this.recursiveIds
      });
    }

    await store.dispatch("getProductBrands");
    await store.dispatch("getAllCategories");
  },
  async beforeRouteEnter(to, from, next) {
    try {
      await store.dispatch("getAllRecursiveCategories");
      next(vm => {
        vm.prevRoute = from;
      });
    } catch (e) {
      next({
        name: "users"
      });
    }
  },
  computed: {
    ...mapState({
      recursedCategories: state => state.category.recursedCategories,
      categories: state => state.category.categories,
      products: state => state.product.products,
      selectedCategory: state => state.category.selectedCategory,
      recursiveIds: state => state.category.recursiveIds,
      productBrands: state => state.product.productBrands,
      searchQuery: state => state.product.searchQuery,
      loading: state => state.product.loading
    }),
    categoryProducts: function() {
      // Apply search query
      let searchedProducts;

      this.searchQuery && this.searchQuery.length > 0
        ? (searchedProducts = search(this.products, this.searchQuery))
        : (searchedProducts = this.products);

      let filteredProducts = [];

      // Filter by Brand
      this.filteredBrands.length > 0
        ? searchedProducts.forEach(product => {
            this.filteredBrands.includes(product.brand_id) &&
              filteredProducts.push(product);
          })
        : (filteredProducts = searchedProducts);

      let matched = [];

      // Filter by Category
      this.products &&
        this.recursiveIds &&
        filteredProducts.forEach(product => {
          this.recursiveIds.includes(product.category_id) &&
            matched.push(product);
        });

      return matched;
    }
  },
  methods: {}
};
</script>
