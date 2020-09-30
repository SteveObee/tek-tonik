<template>
  <div v-if="basket" id="basket">
    <NavButton v-bind:type="'back'" class="mb-2" />
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
        <h4 class="mb-1">Total: £{{ total }}</h4>
      </div>
      <router-link :to="{ name: 'order.payment' }">
        <button class="btn-primary">
          <i class="fas fa-angle-double-right"></i> Proceed to checkout
        </button>
      </router-link>
    </div>
  </div>
  <div v-else>
    <NavButton v-bind:type="'back'" />
    <div class="basket-empty">
      <h3>Basket Empty</h3>
      <i class="fas fa-shopping-cart"></i>
      <h3>Lets go shopping...</h3>
    </div>
  </div>
</template>

<script>
import store from "../../store/index";
import { mapState, mapActions } from "vuex";
import BasketItem from "./BasketItem";
import NavButton from "../layout/NavButton";

export default {
  components: {
    BasketItem,
    NavButton
  },

  async mounted() {
    await store.dispatch("getBasket", this.$store.state.auth.user.id);
    this.basket && store.dispatch("setTotal", this.basket);
    this.compareItems();
  },
  computed: {
    ...mapState({
      basket: state => state.basket.basket,
      nextId: state => state.basket.nextId,
      total: state => state.basket.total,
      errors: state => state.basket.errors
    })
  },
  methods: {
    ...mapActions(["getBasketItem", "setTotal", "emptyBasket"]),
    async compareItems() {
      if (this.basket) {
        let messageText = null;
        let messageType = null;

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

            // Warn of price change via messaging
            messageText = "Price change detected";
            messageType = "warning";
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
          nextId: this.nextId,
          messageText,
          messageType
        });
      }
    },
    handleDeleteClick(e) {
      const newBasket = this.basket.filter(item => item.id !== e);

      if (newBasket.length > 0) {
        store.dispatch("updateBasket", {
          basket: newBasket,
          userId: this.$store.state.auth.user.id,
          nextId: this.nextId,
          messageText: "Item removed from basket",
          messageType: "success"
        });
      } else {
        store.dispatch("emptyBasket", {
          userId: this.$store.state.auth.user.id,
          messageText: "Basket emptied",
          messageType: "success"
        });
      }

      store.dispatch("getBasket", this.$store.state.auth.user.id);
    }
  }
};
</script>
