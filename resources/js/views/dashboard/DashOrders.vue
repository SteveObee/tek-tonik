<template>
  <div>
    <div v-if="orders.length > 0" class="dash-orders">
      <div v-for="order in orders">
        <div>
          <DashOrderItem v-bind:order="order" />
        </div>
      </div>
    </div>
    <div v-else class="c-muted">You have no outstanding orders</div>
  </div>
</template>

<script>
import store from "../../store/index";
import { mapState, mapActions } from "vuex";
import Spinner from "../Spinner";
import DashOrderItem from "./DashOrderItem";

export default {
  async beforeRouteEnter(to, from, next) {
    try {
      await store.dispatch("getUserOrders");
      next();
    } catch (e) {
      next({
        name: "dashboard.profile"
      });
    }
  },
  components: {
    DashOrderItem
  },
  computed: {
    ...mapState({
      loading: state => state.order.loading,
      orders: state => state.order.orders
    })
  }
};
</script>
