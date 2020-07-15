import {
  getBasket,
  addToBasket,
  emptyBasket,
  updateBasket
} from "../actions/basket";

import { POPULATE_BASKET, EMPTY_BASKET } from "../mutations/basket";

const state = {
  basket: null,
  loading: true,
  errors: null,
  nextId: null
};

const mutations = { POPULATE_BASKET, EMPTY_BASKET };

const actions = { getBasket, addToBasket, emptyBasket, updateBasket };

export default {
  state,
  actions,
  mutations
};
