import api from "../../api/address";
import {
  GET_ADDRESSES,
  LOG_ERRORS,
  LOG_MESSAGE,
  CLEAR_MESSAGES,
  SET_SAVING
} from "./types";
import store from "../../store/index";
import { messageHandler } from "../../utils/helpers";

export const getUserAddresses = async ({ commit }, page) => {
  const params = page;

  try {
    const res = await api.user({ params });

    commit({ type: GET_ADDRESSES, data: res.data });
  } catch (err) {
    commit({ type: LOG_ERRORS, errors: err.response.data.message });
  }
};

export const getAllUserAddresses = async ({ commit }) => {
  try {
    const res = await api.all();

    commit({ type: GET_ADDRESSES, data: res.data });
  } catch (err) {
    commit({ type: LOG_ERRORS, errors: err.response.data.message });
  }
};

export const addAddress = async ({ commit }, payload) => {
  try {
    await api.add({
      address_line_1: payload.address_line_1,
      address_line_2: payload.address_line_2,
      county: payload.county,
      city: payload.city,
      postcode: payload.postcode,
      is_shipping: payload.is_shipping,
      is_billing: payload.is_billing
    });

    messageHandler("Address created", "success");
  } catch (err) {
    commit({ type: LOG_ERRORS, errors: err.response.data.message });
  }
};

export const deleteAddress = async ({ commit }, payload) => {
  try {
    await api.delete(payload.id);

    messageHandler("Address deleted", "success");
    store.dispatch("getUserAddresses", { page: 1 });
  } catch (err) {
    commit({ type: LOG_ERRORS, errors: err.response.data.message });
  }
};

export const updateAddress = async ({ commit }, payload) => {
  try {
    // Remove address or detach user from existing
    await api.delete(payload.id);

    // Add address or attach/re-attach user to address
    await api.add({
      address_line_1: payload.address_line_1,
      address_line_2: payload.address_line_2,
      county: payload.county,
      city: payload.city,
      postcode: payload.postcode,
      is_shipping: payload.is_shipping,
      is_billing: payload.is_billing
    });

    messageHandler("Address updated", "success");
  } catch (err) {
    commit({ type: LOG_ERRORS, errors: err });
  }
};

export const resetErrors = ({ commit }) => {
  commit({ type: LOG_ERRORS, errors: null });
};
