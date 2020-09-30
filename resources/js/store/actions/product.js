import {
  GET_PRODUCTS,
  GET_PRODUCT,
  SET_IMAGES,
  CLEAR_IMAGES,
  LOG_ERRORS,
  LOG_MESSAGE,
  SET_BRANDS,
  SET_SEARCH_QUERY,
  SET_SEARCHING
} from "./types";

import api from "../../api/product";

export const getAllProducts = async ({ commit }, payload) => {
  try {
    const params = payload;

    const res = await api.all({ params });

    commit({ type: GET_PRODUCTS, products: res.data });
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

export const updateStock = async ({ commit }, payload) => {
  try {
    const productQuantity = await api.getQuantity(payload.productId);
    const calculatedQuantity = productQuantity.data - payload.quantitySold;

    await api.updateQuantity(payload.productId, {
      newStock: calculatedQuantity
    });
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

export const getProductBrands = async ({ commit }) => {
  try {
    const res = await api.brands();

    commit({ type: SET_BRANDS, brands: res.data });
  } catch (err) {
    console.log(err);
  }
};

export const setSearchQuery = async ({ commit }, payload) => {
  try {
    commit({ type: SET_SEARCH_QUERY, searchQuery: payload });
    commit({ type: SET_SEARCHING, searching: false });
  } catch (err) {
    console.log(err);
  }
};

export const setSearching = async ({ commit }, payload) => {
  try {
    commit({ type: SET_SEARCHING, searching: payload });
  } catch (err) {
    console.log(err);
  }
};

export const testLogging = async ({ commit }, payload) => {
  try {
    commit({ type: LOG_MESSAGE, message: payload });
  } catch (err) {
    console.log(err);
  }
};
