<template>
  <div class="menu-container">
    <div :style="indent" :class="iconClasses">
      <i
        v-if="sub_categories && sub_categories.length > 0"
        @click="toggleChildren()"
        class="menu-item fa"
        :class="iconClasses"
      ></i>
      <p
        v-if="id === selectedCategory.id"
        @click="selectCategory({ id, name })"
        class="d-ib c-primary"
      >
        {{ name }}
      </p>
      <p v-else @click="selectCategory({ id, name })" class="d-ib">
        {{ name }}
      </p>
    </div>

    <Menu
      v-if="showChildren"
      v-for="category in sub_categories"
      :sub_categories="category.sub_categories"
      :name="category.name"
      :depth="depth + 1"
      :id="category.id"
    >
    </Menu>
  </div>
</template>

<script>
import { mapState, mapActions } from "vuex";
import store from "../../store/index";

export default {
  name: "Menu",
  props: ["id", "name", "sub_categories", "depth"],
  data() {
    return { showChildren: false };
  },
  mounted() {
    if (this.id === 1 || this.id === 2) {
      this.toggleChildren();
    }
  },
  computed: {
    ...mapState({
      selectedCategory: state => state.category.selectedCategory,
      recursiveIds: state => state.category.recursiveIds
    }),
    indent() {
      return { transform: `translate(${this.depth * 25}px)` };
    },
    iconClasses() {
      return {
        "menu-item fa-plus-square-o": !this.showChildren,
        "menu-item fa-minus-square-o": this.showChildren
      };
    },
    labelClasses() {
      return { "has-children": this.nodes };
    }
  },
  methods: {
    toggleChildren() {
      this.showChildren = !this.showChildren;
    },
    async selectCategory(e) {
      await store.dispatch("setSelectedCategory", { id: e.id, name: e.name });
      await store.dispatch("getRecursiveCategoryIds", e.id);

      if (this.recursiveIds.length > 1) {
        await store.dispatch("getAllProducts", {
          category_ids: this.recursiveIds
        });
      }
    }
  }
};
</script>
