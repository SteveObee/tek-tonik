import {
  getBasket,
  addToBasket,
  emptyBasket,
  updateBasket,
  setTotal
} from "../actions/basket";

import { POPULATE_BASKET, EMPTY_BASKET, SET_TOTAL } from "../mutations/basket";

const state = {
  basket: null,
  loading: true,
  errors: null,
  nextId: null,
  total: null
};

const mutations = { POPULATE_BASKET, EMPTY_BASKET, SET_TOTAL };

const actions = { getBasket, addToBasket, emptyBasket, updateBasket, setTotal };

export default {
  state,
  actions,
  mutations
};
