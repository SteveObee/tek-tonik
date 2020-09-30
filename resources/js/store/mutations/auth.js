export const SET_LOADING = (state, payload) => {
  state.loading = payload.loading;
};

export const SET_SAVING = (state, payload) => {
  state.saving = payload.saving;
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
  state.loading = false;
};
