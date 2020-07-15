<template>
  <div>
    <div class="basket-item-left">
      <img :src="item.thumbnail" alt="Product Thumbnail" />
      <div>
        <h3>{{ item.brand }} {{ item.name }} {{ item.model }}</h3>
        <p>color: {{ item.color }}</p>
        <p>quantity: {{ item.quantity }}</p>
        <p>Unit price: £{{ item.price }}</p>
      </div>
    </div>
    <div class="basket-item-right">
      <p>Price</p>
      <h4>£{{ item.total }}</h4>
      <button class="btn btn-basket-danger" v-on:click="onDeleteClick(item.id)">
        <p class="sm"><i class="fas fa-times"></i> Remove</p>
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
  }
};
</script>
