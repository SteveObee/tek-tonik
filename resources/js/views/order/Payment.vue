<template>
  <div id="payment">
    <form class="payment-form form">
      <div class="mb-2">
        <h3 class="mb-1">Deliver to</h3>
        <p class="mb-1">{{ user.name }}</p>
        <h3 class="mb-1">Shipping Address</h3>

        <div v-if="shipping" class="mb-1">
          <p>{{ shipping.address_line_1 }}</p>
          <p>{{ shipping.address_line_2 }}</p>
          <p>{{ shipping.county }}</p>
          <p>{{ shipping.city }}</p>
          <p class="mb-1">{{ shipping.postcode }}</p>

          <select
            v-if="shippingAddresses && shippingAddresses.length > 1"
            class="mb-1"
            v-model="shippingId"
          >
            <option
              v-if="shipping"
              v-for="address in shippingAddresses"
              v-bind:value="address.id"
              >{{ address.address_line_1 }}, {{ address.postcode }}</option
            >
          </select>

          <button
            class="btn-primary btn-sm "
            v-on:click.prevent="showShippingForm"
          >
            <i class="fas fa-plus"></i> New
          </button>
        </div>

        <div v-else>
          <button
            v-if="shippingAddresses"
            v-on:click.prevent="closeShippingForm"
            class="btn-light"
          >
            <i class="fas fa-arrow-left"></i> Discard
          </button>
          <AddressForm
            v-bind:dashboard="false"
            v-bind:shipping="true"
            v-bind:creating="true"
          />
        </div>

        <div v-if="shipping">
          <h3 class="mb-1">Billing Address</h3>

          <div class="shipping-toggle">
            <input class="" type="checkbox" v-model="billingIsShipping" />

            <h5 class="">
              Same as Shipping Address
            </h5>
          </div>
        </div>

        <div v-if="billing">
          <p>{{ billing.address_line_1 }}</p>
          <p>{{ billing.address_line_2 }}</p>
          <p>{{ billing.county }}</p>
          <p>{{ billing.city }}</p>
          <p class="mb-1">{{ billing.postcode }}</p>

          <div v-if="!billingIsShipping">
            <select v-if="billingAddresses.length > 1" v-model="billingId">
              <option
                v-for="address in billingAddresses"
                v-bind:value="address.id"
                >{{ address.address_line_1 }}, {{ address.postcode }}</option
              >
            </select>
            <button
              class="btn-sm btn-primary"
              v-on:click.prevent="showBillingForm"
            >
              <i class="fas fa-plus"></i> New
            </button>
          </div>
        </div>

        <div v-else-if="shipping && !billing">
          <button
            v-if="billingAddresses"
            v-on:click.prevent="closeBillingForm"
            class="btn-light"
          >
            <i class="fas fa-arrow-left"></i> Discard
          </button>
          <AddressForm
            v-bind:dashboard="false"
            v-bind:billing="true"
            v-bind:creating="true"
          />
        </div>
      </div>
      <h3 class="mb-1">Estimated delivery date</h3>
      <p v-if="estDelDate" class="mb-2">{{ estDelDate }}</p>

      <div class="payment-item">
        <h3>Total to pay</h3>
        <h4>£{{ vatTotal }}</h4>
      </div>
      <i class="mb-3 text-muted">( Inclusive of vat @ 20% )</i>

      <div v-show="billing" class="d-flex flex-column">
        <p class="c-grey-50 mb-1">
          * The following payment form uses the Stripe Payments Intents API and
          therefore will not accept real credit card details. Further
          information about the Api can be found here:
        </p>
        <a class="c-primary mb-1" href="https://stripe.com/docs/testing"
          ><i class="fas fa-external-link-alt"></i> Stripe Testing</a
        >
        <p class="c-grey-50 mb-1">
          To complete the purchase process simply enter the following details:
        </p>
        <p class="c-grey-50 mb-3">
          4242 4242 4242 4242 (Visa)
          <br />
          (Any future date)
          <br />
          (Any 3 digit number)
          <br />
          (Any 5 digit number)
        </p>

        <div v-if="processing">
          <Spinner />
        </div>

        <div v-else ref="card" class="stripe-element my-1">
          <!-- Stripe Element -->
        </div>
        <div v-if="errors" class="c-danger">
          <p v-for="error in errors">! {{ error }}</p>
          <p>Please try again.</p>
        </div>
        <button
          :disabled="paymentButtonDisabled"
          class="btn btn-primary payment-button"
          type="submit"
          value="Pay"
          v-on:click.prevent="purchase"
        >
          Pay
        </button>
        <p class="payment-tag align-self-end">
          Powered by <i class="fab fa-cc-stripe stripe-logo"></i>
        </p>
      </div>
    </form>

    <div class="payment-right">
      <h3 class="mb-1">Items</h3>
      <div class="payment-collection mb-2">
        <div class="payment-item" v-for="item in basket">
          <p>
            {{ item.quantity }} x {{ item.name }} {{ item.model }} ({{
              item.color
            }})
          </p>
          <p class="payment-item-total">£{{ item.total.toFixed(2) }}</p>
        </div>
      </div>
      <div class="payment-item">
        <h3>Sub Total</h3>
        <p>£{{ totalFixed }}</p>
      </div>
    </div>
  </div>
</template>

<script>
import store from "../../store/index";
import { mapState, mapActions } from "vuex";
import Spinner from "../Spinner";
import AddressForm from "../dashboard/AddressForm";

export default {
  components: {
    AddressForm,
    Spinner
  },
  async beforeRouteEnter(to, from, next) {
    try {
      await store.dispatch("getAllUserAddresses");
      next();
    } catch (e) {
      next({
        name: "basket"
      });
    }
  },
  data() {
    return {
      shippingId: null,
      billingId: null,
      billingIsShipping: true,
      stripe: undefined,
      card: undefined,
      newBilling: false
    };
  },
  async mounted() {
    await store.dispatch("getBasket", this.user.id);
    await store.dispatch("setTotal", this.basket);
    await store.dispatch("getStripeKey");

    this.stripe = Stripe(this.stripeKey);
    this.card = this.stripe.elements().create("card");
    this.card.mount(this.$refs.card);

    if (this.shippingAddresses) {
      this.shippingId = this.shippingAddresses[0].id;
    }

    if (this.billingAddresses) {
      this.billingId = this.billingAddresses[0].id;
    }
  },
  computed: {
    ...mapState({
      auth: state => state.auth.isAuthenticated,
      user: state => state.auth.user,
      basket: state => state.basket.basket,
      total: state => state.basket.total,
      stripeKey: state => state.order.stripeKey,
      processing: state => state.order.processing,
      addresses: state => state.address.addresses,
      errors: state => state.logging.errors
    }),
    totalFixed() {
      return this.total.toFixed(2);
    },
    vatTotal: function() {
      return (this.total * 1.2).toFixed(2);
    },
    shippingAddresses() {
      if (this.addresses) {
        let newShippingAddresses = [];

        this.addresses.forEach(address => {
          address.is_shipping === 1 && newShippingAddresses.push(address);
        });

        if (newShippingAddresses.length > 0) {
          this.shippingId = newShippingAddresses[0].id;
        }

        return newShippingAddresses.length > 0 ? newShippingAddresses : null;
      }
    },
    shipping() {
      if (this.shippingAddresses) {
        let newShipping;

        this.addresses.forEach(address => {
          if (address.id === this.shippingId) {
            newShipping = address;
          }
        });

        return newShipping;
      }
    },
    billingAddresses() {
      if (this.addresses) {
        let newBillingAddresses = [];

        this.addresses.forEach(address => {
          address.is_billing === 1 && newBillingAddresses.push(address);
        });

        if (newBillingAddresses.length > 0) {
          this.billingId = newBillingAddresses[0].id;
        }

        return newBillingAddresses.length > 0 ? newBillingAddresses : null;
      }
    },
    billing() {
      if (this.shipping) {
        let newBilling;

        if (this.billingIsShipping) {
          newBilling = this.shipping;
        } else {
          this.addresses.forEach(address => {
            if (address.id === this.billingId) {
              newBilling = address;
            }
          });
        }

        return newBilling;
      }
    },
    paymentButtonDisabled() {
      return this.processing || !this.shipping || !this.billing ? true : false;
    },
    estDelDate() {
      const timePlusTwo = Date.now() + 172800000;
      const formattedTime = new Date(timePlusTwo).toDateString();

      return formattedTime;
    }
  },
  methods: {
    async purchase() {
      const {
        billingIsShipping,
        shipping,
        billing,
        basket,
        card,
        vatTotal,
        estDelDate,
        cardHolderName
      } = this;

      let billingId;
      let shippingId;

      if (billingIsShipping) {
        let newAddress;

        newAddress = { ...this.shipping };
        newAddress.is_shipping = true;
        newAddress.is_billing = true;

        const res = await store.dispatch("updateAddress", newAddress);

        billingId = res.id;
        shippingId = res.id;
      } else {
        billingId = billing.id;
        shippingId = shipping.id;
      }

      const { paymentMethod, error } = await this.stripe.createPaymentMethod(
        "card",
        card,
        {
          billing_details: { name: cardHolderName }
        }
      );

      const stripedTotal = +this.stripCurrency(vatTotal);

      let res;

      res = await store.dispatch("processTransaction", {
        id: paymentMethod.id,
        amount: stripedTotal
      });

      if (res && res.data.success) {
        const orderId = await store.dispatch("createOrder", {
          userId: this.user.id,
          shippingId,
          billingId,
          total: vatTotal
        });

        await store.dispatch("addOrderItems", {
          basket,
          orderId
        });

        this.updateDatabaseStock(basket);

        await store.dispatch("emailOrderConfirmation", orderId);

        this.$router.push({
          name: "order.complete",
          params: {
            orderId,
            userName: this.user.name,
            userId: this.user.id,
            shipping,
            estDelDate
          }
        });
      } else {
        this.stripe = Stripe(this.stripeKey);
        this.card = this.stripe.elements().create("card");
        this.card.mount(this.$refs.card);
      }
    },
    stripCurrency(val) {
      return val
        .replace(",", "")
        .replace("£", "")
        .replace(".", "");
    },

    async updateDatabaseStock(basket) {
      for await (let item of this.basket) {
        await store.dispatch("updateStock", {
          productId: item.productId,
          quantitySold: item.quantity
        });
      }
    },
    showShippingForm() {
      this.shippingId = null;
    },
    closeShippingForm() {
      this.shippingId = this.shippingAddresses[0].id;
      store.commit("LOG_ERRORS", { errors: null });
    },
    showBillingForm() {
      this.billingId = null;
    },
    closeBillingForm() {
      this.billingId = this.billingAddresses[0].id;
      store.commit("LOG_ERRORS", { errors: null });
    }
  }
};
</script>
