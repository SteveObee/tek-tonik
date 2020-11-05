<template>
  <div>
    <div class="basket-item-left">
      <img :src="item.thumbnail" alt="Product Thumbnail" class="remove-650" />
      <div>
        <h3>{{ item.brand }} {{ item.name }} {{ item.model }}</h3>
        <p>color: {{ item.color }}</p>
        <p>quantity: {{ item.quantity }}</p>
        <p>Unit price: £{{ item.price.toFixed(2) }}</p>
      </div>
    </div>
    <div class="basket-item-right">
      <p>Price</p>
      <h4>£{{ itemTotal }}</h4>
      <button class="btn btn-basket-danger" v-on:click="onDeleteClick(item.id)">
        <p class="sm d-ib"><i class="fas fa-times"></i></p>
        <p class="sm d-ib remove-650">Remove</p>
      </button>
    </div>
  </div>
</template>

<script>
import store from "../../store/index";
import { mapState, mapActions } from "vuex";

export default {
  props: {
    item: Object
  },
  methods: {
    onDeleteClick(event) {
      this.$emit("handle-delete-click", event);
    }
  },
  computed: {
    itemTotal() {
      return this.item.total.toFixed(2);
    }
  }
};
</script>
