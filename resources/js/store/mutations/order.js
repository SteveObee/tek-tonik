export const SET_STRIPE_KEY = (state, payload) => {
  state.loading = false;
  state.stripeKey = payload.key;
};

export const SET_PROCESSING = (state, payload) => {
  state.processing = payload.processing;
};

export const SET_ORDERS = (state, payload) => {
  state.orders = payload.data;
  state.loading = false;
};

export const SET_MESSAGE = (state, payload) => {
  state.message = payload.message;
};
