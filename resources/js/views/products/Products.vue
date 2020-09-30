<template>
  <div
    class="mb-4 products"
    v-if="processedProducts && processedProducts.data.length > 0"
  >
    <h1 v-if="categories" class="section-title">
      {{ categoryName }}
    </h1>
    <div class="bottom-line"></div>

    <div v-if="recursiveIds.length > 1" class="products-content-flex">
      <button
        v-if="processedProducts"
        @click="prev()"
        :disabled="!processedProducts.prevPage"
        class="products-nav"
      >
        <i class="fas fa-chevron-left"></i>
      </button>
      <div v-for="product in processedProducts.data">
        <div>
          <ProductItem :product="product" />
        </div>
      </div>
      <button
        v-if="processedProducts"
        @click="next()"
        :disabled="!processedProducts.nextPage"
        class="products-nav"
      >
        <i class="fas fa-chevron-right"></i>
      </button>
    </div>

    <div v-else>
      <div class="products-content-grid">
        <div v-for="product in processedProducts.data" class="mb-2">
          <div>
            <ProductItem :product="product" />
          </div>
        </div>
      </div>
      <div class="d-flex flex-center">
        <button
          v-if="processedProducts"
          @click="prev()"
          :disabled="!processedProducts.prevPage"
          class="products-nav-grid"
        >
          <i class="fas fa-chevron-left"></i>
        </button>
        <h4 class="">
          {{ processedProducts.currentPage }} /
          {{ processedProducts.totalPages }}
        </h4>
        <button
          v-if="processedProducts"
          @click="next()"
          :disabled="!processedProducts.nextPage"
          class="products-nav-grid"
        >
          <i class="fas fa-chevron-right"></i>
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState, mapActions } from "vuex";
import api from "../../api/product";
import axios from "axios";
import store from "../../store/index";
import ProductItem from "./ProductItem";
import Spinner from "../Spinner";
import { paginateCollection } from "../../utils/pagination";

export default {
  props: {
    categoryId: {
      type: Number
    },
    categories: {
      type: Array
    },
    filteredBrands: {
      type: Array
    },
    recursiveIds: {
      type: Array
    },
    sortedPrice: {
      type: String
    },
    products: {
      type: Array
    }
  },
  data() {
    return {
      page: 1,
      perPage: 4
    };
  },
  name: "Products",
  components: {
    ProductItem
  },
  computed: {
    ...mapState({
      searchQuery: state => state.product.searchQuery
    }),
    productsPerPage: function() {
      return this.recursiveIds.length > 1 ? 3 : this.perPage;
    },
    processedProducts: function() {
      return this.processProducts(
        this.page,
        this.productsPerPage,
        this.filteredBrands,
        this.products
      );
    },
    categoryName: function() {
      return this.calculateCategoryName();
    }
  },
  methods: {
    processProducts(toPage, productsPerPage, filteredBrands, products) {
      if (products) {
        // Filter by category
        let categoryProducts = [];

        products.forEach(product => {
          if (product.category_id === this.categoryId) {
            categoryProducts.push(product);
          }
        });

        let sortedProducts;

        // Sort by price
        if (this.sortedPrice === "desc") {
          sortedProducts = categoryProducts.slice().sort(function(a, b) {
            return b.price - a.price;
          });
        } else if (this.sortedPrice === "asc") {
          sortedProducts = categoryProducts.slice().sort(function(a, b) {
            return a.price - b.price;
          });
        }

        return paginateCollection(sortedProducts, productsPerPage, toPage);
      }
    },
    async prev() {
      if (this.processedProducts.prevPage) {
        this.page = this.processedProducts.currentPage - 1;
      }
    },
    async next() {
      if (this.processedProducts.nextPage) {
        this.page = this.processedProducts.currentPage + 1;
      }
    },
    calculateCategoryName() {
      let categoryName;

      this.categories.forEach(category => {
        if (category.id === this.categoryId) {
          categoryName = category.name;
        }
      });

      return categoryName;
    }
  }
};
</script>
