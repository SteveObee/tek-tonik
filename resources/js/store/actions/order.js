import {
  SET_STRIPE_KEY,
  LOG_ERRORS,
  SET_PROCESSING,
  SET_ORDERS,
  SET_MESSAGE
} from "./types";

import api from "../../api/order";

export const getStripeKey = async ({ commit }) => {
  try {
    const res = await api.getKey();

    commit({ type: SET_STRIPE_KEY, key: res.data });
  } catch (err) {
    commit({ type: LOG_ERRORS, errors: err.response.data.message });
  }
};

export const processTransaction = async ({ commit }, payload) => {
  try {
    commit({ type: SET_PROCESSING, processing: true });

    const res = await api.charge(payload);

    if (res.data.success) {
      commit({ type: SET_PROCESSING, processing: false });
    }
  } catch (err) {
    commit({ type: LOG_ERRORS, errors: err.response.data.message });
  }
};

export const getUserOrders = async ({ commit }) => {
  try {
    const res = await api.get();

    commit({ type: SET_ORDERS, data: res.data });
  } catch (err) {
    commit({ type: LOG_ERRORS, errors: err.response.data.message });
  }
};

export const createOrder = async ({ commit }, payload) => {
  try {
    const res = await api.create({
      userId: payload.userId,
      addressId: payload.addressId,
      total: payload.total
    });

    return res.data.orderId;
  } catch (err) {
    commit({ type: LOG_ERRORS, errors: err.response.data.message });
  }
};

export const deleteOrder = async ({ commit }, payload) => {
  try {
    const res = await api.update(payload.id, {
      status_code: payload.statusCode
    });

    console.log(res);

    commit({ type: SET_MESSAGE, message: "Order Cancelled" });
  } catch (err) {
    console.log(err);
  }
  setTimeout(() => commit({ type: SET_MESSAGE, message: null }), 5000);
};

export const addOrderItems = async ({ commit }, payload) => {
  try {
    for await (let item of payload.basket) {
      const newOrderItem = {
        orderId: payload.orderId,
        productId: item.productId,
        name: item.brand + " " + item.name + " " + item.model,
        price: item.price,
        quantity: item.quantity,
        description: item.description
      };

      const res = await api.add(newOrderItem);
    }
  } catch (err) {
    commit({ type: LOG_ERRORS, errors: err.response.data.message });
  }
};

export const emailOrderConfirmation = async ({ commit }, payload) => {
  try {
    const res = await api.confirmation(payload);
  } catch (err) {
    commit({ type: LOG_ERRORS, errors: err.response.data.message });
  }
};
