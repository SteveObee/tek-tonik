import {
  GET_PRODUCTS,
  GET_PRODUCT,
  SET_IMAGES,
  CLEAR_IMAGES,
  LOG_ERRORS
} from "./types";

import api from "../../api/product";

export const getAllProducts = async ({ commit }) => {
  try {
    const res = await api.all();

    commit({ type: GET_PRODUCTS, products: res.data.data });
  } catch (err) {
    commit({ type: LOG_ERRORS, errors: err.response.data.message });
  }
};

export const getProduct = async ({ commit }, id) => {
  try {
    const res = await api.find(id);

    commit({ type: GET_PRODUCT, product: res.data });
  } catch (err) {
    commit({ type: LOG_ERRORS, errors: err.response.data.message });
  }
};

export const getImages = async ({ commit }, payload) => {
  const params = {};
  params.page = payload.page;

  try {
    const res = await api.images(payload.id, { params });

    commit({ type: SET_IMAGES, images: res.data });
  } catch (err) {
    commit({ type: LOG_ERRORS, errors: err.response.data.message });
  }
};

export const clearImages = async ({ commit }) => {
  try {
    commit({ type: CLEAR_IMAGES });
  } catch (err) {
    console.log(err);

    commit({ type: LOG_ERRORS, errors: err.response.data.message });
  }
};

export const getBasketItem = async ({ commit }, id) => {
  try {
    const res = await api.find(id);
    const filteredResponse = {
      price: res.data.price,
      stock: res.data.stock
    };

    return filteredResponse;
  } catch (err) {
    console.log("Something went wrong");
  }
};
