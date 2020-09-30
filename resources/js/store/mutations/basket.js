export const POPULATE_BASKET = (state, payload) => {
  state.loading = false;
  state.basket = payload.basket.items;
  state.nextId = payload.basket.nextId;
};

export const EMPTY_BASKET = state => {
  state.basket = null;
};

export const SET_TOTAL = (state, payload) => {
  state.total = payload.total.toFixed(2);
};
