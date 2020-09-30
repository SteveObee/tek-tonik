import {
  LOGIN_USER,
  LOG_ERRORS,
  SET_LOADING,
  LOAD_USER,
  LOGOUT_USER,
  REGISTER_USER,
  SET_AUTHENTICATED,
  EMPTY_BASKET
} from "./types";

import api from "../../api/auth";

export const loginUser = async ({ commit }, payload) => {
  try {
    commit({ type: SET_LOADING, loading: true });
    await api.csrf();
    const res = await api.login({
      email: payload.email,
      password: payload.password
    });

    commit({ type: LOGIN_USER });
    commit({ type: LOG_ERRORS, errors: null });
  } catch (err) {
    commit({ type: LOG_ERRORS, errors: err.response.data.message });
  }
};

export const logoutUser = async ({ commit }) => {
  try {
    await api.logout();

    commit({ type: EMPTY_BASKET });
    commit({ type: LOGOUT_USER });
  } catch (err) {
    commit({ type: LOG_ERRORS, errors: err.response.data.message });
  }
};

export const loadUser = async ({ commit }) => {
  try {
    commit({ type: SET_AUTHENTICATED, authenticated: false });
    commit({ type: SET_LOADING, loading: true });
    const res = await api.load();

    if (res.data) {
      commit({ type: LOAD_USER, user: res.data });
      commit({ type: SET_AUTHENTICATED, authenticated: true });
    }

    commit({ type: SET_LOADING, loading: false });
  } catch (err) {
    commit({ type: LOG_ERRORS, errors: err.response.data.message });
  }
};

export const registerUser = async ({ commit }, payload) => {
  try {
    commit({ type: SET_LOADING, loading: true });
    await api.register({
      name: payload.name,
      email: payload.email,
      password: payload.password,
      password_confirmation: payload.password_confirmation
    });

    commit({ type: REGISTER_USER });
    commit({ type: LOG_ERRORS, errors: null });
  } catch (err) {
    commit({ type: LOG_ERRORS, errors: err.response.data.message });
  }
};
