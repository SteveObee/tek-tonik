<template>
  <div v-if="!this.userName" class="text-center">
    <h3 class="mb-2 text-muted">Redirecting</h3>
    <Spinner />
  </div>
  <div v-else id="completed">
    <div class="completed-left">
      <h3 class="mb-2">Order placed, thank you for your custom!</h3>
      <div class="order-info">
        <h4 class="mb-1">Order #{{ orderId }}</h4>
        <h4 class="mb-1">Delivering to:</h4>
        <div v-if="address" class="mb-1">
          <p v-if="userName">{{ userName }}</p>
          <p>{{ address.address_line_1 }}</p>
          <p>{{ address.address_line_2 }}</p>
          <p>{{ address.city }}</p>
          <p>{{ address.county }}</p>
          <p>{{ address.postcode }}</p>
        </div>
        <h4 class="mb-1">Estimated delivery date:</h4>
        <p v-if="estDelDate">{{ estDelDate }}</p>
      </div>
    </div>
    <div class="completed-right">
      <h2 class="mb-1">Where next?</h2>
      <h1><i class="fas fa-road mb-3"></i></h1>
      <h3 class="mb-1">
        <router-link class="r-link" :to="{ name: 'dashboard.orders' }"
          ><i class="fas fa-cogs"></i> View your orders</router-link
        >
      </h3>
      <h3>
        <router-link class="r-link" :to="{ name: 'products.index' }"
          ><i class="fas fa-shopping-bag"></i> Continue shopping</router-link
        >
      </h3>
    </div>
  </div>
</template>

<script>
import store from "../../store/index";
import { mapState, mapActions } from "vuex";
import Spinner from "../Spinner";

export default {
  components: {
    Spinner
  },
  props: {
    userName: {
      type: String
    },
    userId: {
      type: Number
    },
    orderId: {
      type: Number
    },
    address: {
      type: Object
    },
    estDelDate: {
      type: String
    }
  },
  async mounted() {
    await store.dispatch("emptyBasket", this.userId);
    this.redirect();
  },
  methods: {
    redirect() {
      if (this.orderId) {
        return;
      } else {
        this.$router.push({ path: "/products" });
      }
    }
  }
};
</script>
