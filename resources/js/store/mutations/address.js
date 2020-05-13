export const GET_ADDRESSES = (state, payload) => {
  state.addresses = payload.data;
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
