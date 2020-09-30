import {
  getStripeKey,
  getUserOrders,
  processTransaction,
  addOrderItems,
  createOrder,
  deleteOrder,
  emailOrderConfirmation
} from "../actions/order";
import {
  SET_STRIPE_KEY,
  SET_PROCESSING,
  SET_ORDERS,
  SET_MESSAGE
} from "../mutations/order";

const state = {
  orders: null,
  loading: true,
  stripeKey: null,
  processing: false,
  errors: null,
  message: null
};

const mutations = {
  SET_STRIPE_KEY,
  SET_PROCESSING,
  SET_ORDERS,
  SET_MESSAGE
};

const actions = {
  getStripeKey,
  getUserOrders,
  processTransaction,
  addOrderItems,
  createOrder,
  deleteOrder,
  emailOrderConfirmation
};

export default {
  state,
  actions,
  mutations
};
