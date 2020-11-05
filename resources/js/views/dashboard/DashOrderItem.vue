<template>
  <div v-if="expanded">
    <div class="card mb-2">
      <div class="dash-orders-left">
        <h4>Order #{{ order.id }}</h4>
        <h4>{{ order.created_at }}</h4>
        <h4 class="mb-1">
          Status:
          <span v-bind:class="classObject">{{ order.status.description }}</span>
        </h4>
        <h4>Delivery address</h4>
        <p>{{ order.address.address_line_1 }}</p>
        <p>{{ order.address.address_line_2 }}</p>
        <p>{{ order.address.city }}</p>
        <p>{{ order.address.county }}</p>
        <p>{{ order.address.postcode }}</p>
      </div>
      <div class="dash-orders-middle">
        <h4>Order details</h4>
        <div class="mb-1">
          <p v-for="item in order.order_items">
            {{ item.quantity }} x {{ item.name }} @ £{{
              item.price_then.toFixed(2)
            }}
          </p>
        </div>
        <h4>Total after VAT</h4>
        <p>£{{ orderTotalFixed }}</p>
      </div>
      <div class="dash-orders-right">
        <div v-on:click="expanded = !expanded" class="card-toggle">
          <i class="fas fa-chevron-up"></i>
        </div>
        <button
          v-on:click="onCancelClick({ id: order.id })"
          v-if="order.status.id === 1"
          class="btn btn-danger btn-sm"
        >
          <i class="fas fa-times"></i> Cancel
        </button>
      </div>
    </div>
  </div>

  <div v-else class="card mb-2">
    <div class="">
      <h4>Order #{{ order.id }}</h4>
    </div>
    <div v-bind:class="classObject" class="dash-orders-middle">
      {{ order.status.description }}
    </div>
    <div class="dash-orders-right">
      <div v-on:click="expanded = !expanded" class="card-toggle">
        <i class="fas fa-chevron-down"></i> Details
      </div>
    </div>
  </div>
</template>

<script>
import store from "../../store/index";
import { messageHandler } from "../../utils/helpers";

export default {
  props: {
    order: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      expanded: false
    };
  },
  watch: {
    order: function(newVal, oldVal) {
      this.expanded = false;
    }
  },
  computed: {
    classObject() {
      return {
        "c-primary": this.order.status.id === 1,
        "c-warning": this.order.status.id === 2,
        "c-success": this.order.status.id === 3,
        "c-danger": this.order.status.id === 4
      };
    },
    orderTotalFixed() {
      return this.order.total.toFixed(2);
    }
  },
  methods: {
    async onCancelClick(e) {
      await messageHandler("Really cancel Order?", "warning", [
        {
          action: "deleteOrder",
          payload: { id: e.id, statusCode: 4 }
        },
        {
          action: "getUserOrders",
          payload: null
        }
      ]);
    }
  }
};
</script>
