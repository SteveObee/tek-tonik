import {
  getAllProducts,
  getProduct,
  getImages,
  clearImages,
  getBasketItem,
  updateStock,
  getProductBrands,
  setSearchQuery,
  setSearching,
  testLogging
} from "../actions/product";
import {
  GET_PRODUCTS,
  GET_PRODUCT,
  SET_IMAGES,
  CLEAR_IMAGES,
  SET_BRANDS,
  SET_SEARCH_QUERY,
  SET_SEARCHING
} from "../mutations/product";

const state = {
  products: null,
  product: null,
  categories: null,
  images: null,
  productBrands: null,
  searchQuery: null,
  searching: false,
  loading: true,
  errors: null
};

const actions = {
  getAllProducts,
  getProduct,
  getImages,
  clearImages,
  getBasketItem,
  updateStock,
  getProductBrands,
  setSearchQuery,
  setSearching,
  testLogging
};

const mutations = {
  GET_PRODUCTS,
  GET_PRODUCT,
  SET_IMAGES,
  CLEAR_IMAGES,
  SET_SEARCHING,
  SET_BRANDS,
  SET_SEARCH_QUERY
};

export default {
  state,
  actions,
  mutations
};
