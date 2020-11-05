export const GET_ADDRESSES = (state, payload) => {
  state.addresses = payload.addresses;
  state.loading = false;
};

export const SET_MESSAGE = (state, payload) => {
  state.message = payload.message;
};
