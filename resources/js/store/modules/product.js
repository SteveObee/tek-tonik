import {
  getAllProducts,
  getProduct,
  getImages,
  clearImages,
  getBasketItem
} from "../actions/product";
import {
  GET_PRODUCTS,
  GET_PRODUCT,
  SET_IMAGES,
  CLEAR_IMAGES,
  LOG_ERRORS,
  SET_SAVING,
  SET_MESSAGE
} from "../mutations/product";

const state = {
  products: null,
  product: null,
  images: null,
  loading: true,
  errors: null
};

const actions = {
  getAllProducts,
  getProduct,
  getImages,
  clearImages,
  getBasketItem
};

const mutations = {
  GET_PRODUCTS,
  GET_PRODUCT,
  SET_IMAGES,
  CLEAR_IMAGES,
  LOG_ERRORS,
  SET_SAVING,
  SET_MESSAGE
};

export default {
  state,
  actions,
  mutations
};
