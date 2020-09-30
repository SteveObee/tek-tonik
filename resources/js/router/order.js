import Payment from "../views/order/Payment.vue";
import Complete from "../views/order/Complete.vue";

export default [
  {
    path: "/payment",
    name: "order.payment",
    title: "Payment",
    component: Payment
  },
  {
    path: "/complete",
    name: "order.complete",
    props: true,
    title: "Complete",
    component: Complete
  }
];
