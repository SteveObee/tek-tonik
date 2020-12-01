import {
  LOGIN_USER,
  LOG_ERRORS,
  SET_LOADING,
  LOAD_USER,
  LOGOUT_USER,
  REGISTER_USER,
  SET_AUTHENTICATED,
  EMPTY_BASKET,
  SET_TOTAL,
  GET_ADDRESSES
} from "./types";

import api from "../../api/auth";
import { messageHandler } from "../../utils/helpers";

export const loginUser = async ({ commit }, payload) => {
  try {
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
    commit({ type: GET_ADDRESSES, addresses: null });
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

export const resetPassword = async ({ commit }, payload) => {
  try {
    const { email, password, passwordConfirm, token } = payload;

    const res = await api.reset({
      email,
      password,
      password_confirmation: passwordConfirm,
      token
    });

    messageHandler(res.data.message, "success");
    commit({ type: LOG_ERRORS, errors: null });
  } catch (err) {
    commit({ type: LOG_ERRORS, errors: err.response.data.message });
  }
};
