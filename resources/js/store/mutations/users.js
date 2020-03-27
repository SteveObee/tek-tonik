export const GET_USERS = (state, payload) => {
  state.loading = false;
  state.users = payload.users;
};

export const GET_USER = (state, payload) => {
  state.loading = false;
  state.user = payload.user;
};

export const LOG_ERRORS = (state, payload) => {
  state.loading = false;
  state.errors = payload.errors;
};

export const SET_LOADING = (state, payload) => {
  state.loading = payload.loading;
};

export const SET_SAVING = (state, payload) => {
  state.saving = payload.saving;
};

export const SET_MESSAGE = (state, payload) => {
  state.message = payload.message;
};

export const RESET_STATE = state => {
  state.users = null;
  state.errors = null;
};
