export const SET_LOADING = (state, payload) => {
  state.loading = payload.loading;
};

export const SET_AUTHENTICATED = (state, payload) => {
  state.isAuthenticated = payload.authenticated;
};

export const LOGIN_USER = state => {
  state.isAuthenticated = true;
};

export const REGISTER_USER = state => {
  state.isAuthenticated = true;
};

export const LOGOUT_USER = state => {
  state.isAuthenticated = false;
  state.user = null;
};

export const LOAD_USER = (state, payload) => {
  state.user = payload.user;
};

export const LOG_ERRORS = (state, payload) => {
  state.loading = false;
  state.errors = payload.errors;
};
