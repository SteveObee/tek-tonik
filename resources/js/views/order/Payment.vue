<template>
  <div id="payment">
    <form class="payment-form">
      <div class="address mb-2">
        <h3 class="mb-1">Deliver to</h3>
        <p>{{ user.name }}</p>
        <div v-if="address">
          <p>{{ address.address_line_1 }}</p>
          <p>{{ address.address_line_2 }}</p>
          <p>{{ address.city }}</p>
          <p>{{ address.county }}</p>
          <p>{{ address.postcode }}</p>
        </div>
      </div>
      <h3 class="mb-1">Estimated delivery date</h3>
      <p v-if="estDelDate" class="mb-2">{{ estDelDate }}</p>
      <div class="payment-item">
        <h3>Total to pay</h3>
        <h4>£{{ vatTotal }}</h4>
      </div>
      <i class="mb-3 text-muted">( Inclusive of vat @ 20% )</i>
      <div v-if="processing">
        <Spinner />
      </div>
      <div v-else ref="card" class="stripe-element">
        <!-- Stripe Element-->
      </div>
      <button
        :disabled="processing"
        class="btn btn-primary payment-button"
        type="submit"
        value="Pay"
        v-on:click.prevent="purchase"
      >
        Pay
      </button>
      <p class="payment-tag">
        Powered by <i class="fab fa-cc-stripe stripe-logo"></i>
      </p>
    </form>
    <div class="payment-right">
      <h3 class="mb-1">Items</h3>
      <div class="payment-collection mb-2">
        <div class="payment-item" v-for="item in basket">
          <p>{{ item.quantity }} x {{ item.name }} {{ item.model }}</p>
          <p class="payment-item-total">£{{ item.total }}</p>
        </div>
      </div>
      <div class="payment-item">
        <h3>Sub Total</h3>
        <p>£{{ total }}</p>
      </div>
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
  data() {
    return {
      stripe: undefined,
      card: undefined,
      address: null,
      estDelDate: null
    };
  },
  async mounted() {
    await store.dispatch("getStripeKey");
    await store.dispatch("setTotal", this.basket);
    await store.dispatch("getAllUserAddresses");

    this.address = this.addresses[0];

    this.stripe = Stripe(this.stripeKey);
    this.card = this.stripe.elements().create("card");
    this.card.mount(this.$refs.card);

    this.calculateEtd();
  },
  computed: {
    ...mapState({
      basket: state => state.basket.basket,
      total: state => state.basket.total,
      stripeKey: state => state.order.stripeKey,
      processing: state => state.order.processing,
      addresses: state => state.address.addresses,
      user: state => state.auth.user,
      errors: state => state.order.errors
    }),
    vatTotal: function() {
      return (this.total * 1.2).toFixed(2);
    }
  },
  methods: {
    async purchase() {
      this.lockSubmit = true;

      try {
        const { paymentMethod, error } = await this.stripe.createPaymentMethod(
          "card",
          this.card,
          {
            billing_details: { name: this.cardHolderName }
          }
        );

        const stripedTotal = +this.stripCurrency(this.vatTotal);

        await store.dispatch("processTransaction", {
          id: paymentMethod.id,
          amount: stripedTotal
        });

        const orderId = await store.dispatch("createOrder", {
          userId: this.user.id,
          addressId: this.address.id,
          total: this.vatTotal
        });

        await store.dispatch("addOrderItems", {
          basket: this.basket,
          orderId
        });

        this.updateDatabaseStock(this.basket);

        await store.dispatch("emailOrderConfirmation", orderId);

        this.$router.push({
          name: "order.complete",
          params: {
            orderId,
            userName: this.user.name,
            userId: this.user.id,
            address: this.address,
            estDelDate: this.estDelDate
          }
        });
      } catch (error) {
        console.log(error);
      }
    },
    stripCurrency(val) {
      return val
        .replace(",", "")
        .replace("£", "")
        .replace(".", "");
    },
    calculateEtd() {
      const timePlusTwo = Date.now() + 172800000;
      const formattedTime = new Date(timePlusTwo).toDateString();

      this.estDelDate = formattedTime;
    },
    async updateDatabaseStock(basket) {
      for await (let item of this.basket) {
        await store.dispatch("updateStock", {
          productId: item.productId,
          quantitySold: item.quantity
        });
      }
    }
  }
};
</script>
