export const GET_PRODUCTS = (state, payload) => {
  state.products = payload.products;
  state.loading = false;
};

export const SET_IMAGES = (state, payload) => {
  state.images = payload.images;
  state.loading = false;
};

export const CLEAR_IMAGES = state => {
  state.images = null;
  state.loading = false;
};

export const GET_PRODUCT = (state, payload) => {
  state.product = payload.product;
  state.loading = false;
};

export const LOG_ERRORS = (state, payload) => {
  state.errors = payload.errors;
  state.loading = false;
};

export const SET_MESSAGE = (state, payload) => {
  state.message = payload.message;
};

export const SET_SAVING = (state, payload) => {
  state.saving = payload.saving;
};
