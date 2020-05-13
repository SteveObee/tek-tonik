import api from "../../api/address";
import { GET_ADDRESSES, LOG_ERRORS, SET_MESSAGE, SET_SAVING } from "./types";

export const getUserAddresses = async ({ commit }, page) => {
  console.log(page);

  const params = page;

  try {
    const res = await api.user({ params });

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

    commit({ type: SET_MESSAGE, message: "Address created" });
    commit({ type: LOG_ERRORS, errors: null });
  } catch (err) {
    commit({ type: LOG_ERRORS, errors: err.response.data.message });
  }
  setTimeout(() => commit({ type: SET_MESSAGE, message: null }), 5000);
};

export const deleteAddress = async ({ commit }, payload) => {
  try {
    await api.delete(payload.id);

    commit({ type: SET_MESSAGE, message: "Address deleted" });
    commit({ type: LOG_ERRORS, errors: null });
  } catch (err) {
    commit({ type: LOG_ERRORS, errors: err.response.data.message });
  }

  setTimeout(() => commit({ type: SET_MESSAGE, message: null }), 5000);
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

    commit({ type: SET_MESSAGE, message: "Address updated" });
    commit({ type: LOG_ERRORS, errors: null });
  } catch (err) {
    commit({ type: LOG_ERRORS, errors: err.response.data.message });
  }
  setTimeout(() => commit({ type: SET_MESSAGE, message: null }), 5000);
};

export const resetErrors = ({ commit }) => {
  commit({ type: LOG_ERRORS, errors: null });
};
