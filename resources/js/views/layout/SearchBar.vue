<template>
  <div class="search-bar">
    <i v-if="searching" class="fas fa-cog rotating"></i>
    <i
      v-else-if="searchField"
      class="fas fa-times cu-point"
      @click="clearSearch()"
    ></i>
    <i v-else class="fas fa-search"></i>
    <input
      type="text"
      :placeholder="'Search ' + [[selectedCategory.name]] + '...'"
      v-model="searchField"
      @input="onInput()"
    />
  </div>
</template>

<script>
import { mapState, mapActions } from "vuex";
import store from "../../store/index";
import { debounce } from "../../utils/helpers";

export default {
  data() {
    return {
      searchField: null
    };
  },
  mounted() {
    this.searchField = this.searchQuery;
  },
  watch: {
    searchField: debounce(function(newVal) {
      store.dispatch("setSearchQuery", newVal);
    }, 1000)
  },
  computed: {
    ...mapState({
      searching: state => state.product.searching,
      selectedCategory: state => state.category.selectedCategory,
      searchQuery: state => state.product.searchQuery
    })
  },
  methods: {
    onInput() {
      store.dispatch("setSearching", true);
    },
    clearSearch() {
      this.searchField = null;
      store.dispatch("setSearchQuery", null);
    }
  }
};
</script>
