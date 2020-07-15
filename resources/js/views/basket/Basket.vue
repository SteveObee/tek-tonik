<template>
  <div v-if="basket" id="basket">
    <div v-for="item in basket" v-bind:key="item.id">
      <BasketItem
        @handle-delete-click="handleDeleteClick"
        v-bind:item="item"
        class="basket-item my-2"
      />
      <h5 v-if="item.priceDiff && item.priceDiff < 0" class="price-diff">
        {{ item.model }} price has decreased by £{{
          item.priceDiff.toString().slice(1)
        }}
        since
        {{ item.prevUpdatedAt }}
      </h5>
      <h5 v-else-if="item.priceDiff" class="price-diff">
        {{ item.model }} price has increased by £{{ item.priceDiff }} since
        {{ item.prevUpdatedAt }}
      </h5>
    </div>
    <hr />
    <div class="basket-bottom" v-if="this.basket.length > 0">
      <div class="basket-total py-2">
        <h4 class="mb-1">Sub total: £{{ grandTotal }}</h4>
        <h3>Total inclusive of VAT at 19%: £{{ vatTotal }}</h3>
      </div>
      <button class="btn-primary">
        <i class="fas fa-angle-double-right"></i> Proceed to checkout
      </button>
    </div>
  </div>
</template>

<script>
import store from "../../store/index";
import { mapState, mapActions } from "vuex";
import BasketItem from "./BasketItem";

export default {
  components: {
    BasketItem
  },
  mounted() {
    store.dispatch("getBasket", this.$store.state.auth.user.id);
    this.compareItems();
  },
  data() {
    return {};
  },
  computed: {
    ...mapState({
      basket: state => state.basket.basket,
      nextId: state => state.basket.nextId
    }),
    grandTotal: function() {
      if (this.basket.length > 0) {
        const total = this.basket
          .map(item => item.total)
          .reduce((a, b) => {
            return a + b;
          });

        return total.toFixed(2);
      }
    },
    vatTotal: function() {
      return (this.grandTotal * 1.19).toFixed(2);
    }
  },
  methods: {
    ...mapActions(["getBasketItem"]),
    async compareItems() {
      if (this.basket) {
        for await (let item of this.basket) {
          // Get current values for product
          const currentProduct = await store.dispatch(
            "getBasketItem",
            item["productId"]
          );

          const currentTime = new Date();
          const currentTimestamp = currentTime.toUTCString();

          // Check stored price is correct
          if (currentProduct.price != item.price) {
            // Get price diff for stored and current price
            const itemPriceDiff = currentProduct.price - item.price;
            // Update price in state to current price
            item.price = currentProduct.price;

            // Set previous price diff and timestamp to notify user
            item.priceDiff = parseFloat(itemPriceDiff.toFixed(2));

            // Set prevUpdatedAt timestamp to existing updatedAt
            item.prevUpdatedAt = item.updatedAt;
            // Set updatedAt timestamp to current time
            item.updatedAt = currentTimestamp;

            // Set previous price diff and timestamp to notify user
            item.priceDiff = parseFloat(itemPriceDiff.toFixed(2));
          } else {
            // Stored and current price the same. Reset price diff
            item.priceDiff = null;
          }

          item.total = parseFloat((item.price * item.quantity).toFixed(2));
        }

        // Update price diff in local storage
        store.dispatch("updateBasket", {
          basket: this.basket,
          userId: this.$store.state.auth.user.id,
          nextId: this.nextId
        });
      }
    },
    handleDeleteClick(e) {
      const newBasket = this.basket.filter(item => item.id !== e);

      store.dispatch("updateBasket", {
        basket: newBasket,
        userId: this.$store.state.auth.user.id,
        nextId: this.nextId
      });

      store.dispatch("getBasket", this.$store.state.auth.user.id);
    }
  }
};
</script>
