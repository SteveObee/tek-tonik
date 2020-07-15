<template>
  <div v-if="basket" id="basket">
    <div v-for="item in basket" class="basket-item my-2">
      <div class="basket-item-left">
        <img :src="item.thumbnail" alt="Product Thumbnail" />
        <div>
          <h3>{{ item.brand }} {{ item.name }} {{ item.model }}</h3>
          <p>color: {{ item.color }}</p>
          <p>quantity: {{ item.quantity }}</p>
          <p>price: {{ item.price }}</p>
        </div>
      </div>
      <div class="basket-item-right">
        <p>Total price</p>
        <h4>£{{ item.total }}</h4>
      </div>
      <h3 v-if="item.priceDiff">Price diff {{ item.priceDiff }}</h3>
    </div>
  </div>
</template>

<script>
import store from "../../store/index";
import { mapState, mapActions } from "vuex";
import BasketItem from "./BasketItem";

export default {
  mounted() {
    store.dispatch("getBasket", this.$store.state.auth.user.id);
    this.compareItems();
  },
  data() {
    return {};
  },
  computed: {
    ...mapState({
      basket: state => state.basket.basket
    })
  },
  methods: {
    ...mapActions(["getBasketItem"]),
    async compareItems() {
      for await (let item of this.basket) {
        // Get current values for product
        const currentProduct = await store.dispatch(
          "getBasketItem",
          item["productId"]
        );

        // Check stored price is correct
        if (currentProduct.price != item.price) {
          // Get price diff for stored and current price
          const itemPriceDiff = currentProduct.price - item.price;
          // Update price in state to current price
          item.price = currentProduct.price;

          // Update outdated item price in local storage
          store.dispatch("updateBasket", {
            basket: this.basket,
            userId: this.$store.state.auth.user.id
          });

          // Set price diff to notify user
          item.priceDiff = itemPriceDiff.toFixed(2);
        } else {
          // Stored and current price the same. Reset price diff
          item.priceDiff = null;

          // Update price diff in local storage
          store.dispatch("updateBasket", {
            basket: this.basket,
            userId: this.$store.state.auth.user.id
          });
        }

        item.total = (currentProduct.price * item.quantity).toFixed(2);
      }
    }
  }
};
</script>
