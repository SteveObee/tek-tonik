import Payment from "../views/order/Payment.vue";
import Complete from "../views/order/Complete.vue";
import store from "../store/index";

export default [
  {
    path: "/payment",
    name: "order.payment",
    title: "Payment",
    component: Payment,
    beforeEnter: (to, from, next) => {
      !store.state.auth.isAuthenticated ? next({ name: "login" }) : next();
    }
  },
  {
    path: "/complete",
    name: "order.complete",
    props: true,
    title: "Complete",
    component: Complete
  }
];
