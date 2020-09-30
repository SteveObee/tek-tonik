export const GET_USERS = (state, payload) => {
  state.loading = false;
  state.users = payload.users;
};

export const GET_USER = (state, payload) => {
  state.loading = false;
  state.auth.user = payload.user;
};

export const SET_LOADING = (state, payload) => {
  state.loading = payload.loading;
};

export const SET_MESSAGE = (state, payload) => {
  state.message = payload.message;
};

export const RESET_STATE = state => {
  state.users = null;
  state.errors = null;
};
