import {
  GET_USERS,
  GET_USER,
  LOG_ERRORS,
  SET_LOADING,
  SET_SAVING,
  SET_MESSAGE,
  RESET_STATE
} from "./types";

import axios from "axios";
import api from "../../api/users";

export const getUsers = async ({ commit }, page) => {
  const params = page;

  try {
    commit({ type: SET_LOADING, loading: true });
    const res = await axios.get("/api/users", { params });

    // commit(RESET_STATE);
    commit({ type: GET_USERS, users: res.data });
  } catch (err) {
    commit({ type: LOG_ERRORS, errors: err.response.data.message });
  }
  commit({ type: LOG_ERRORS, errors: null });
};

export const getUser = async ({ commit }, payload) => {
  try {
    commit({ type: SET_LOADING, loading: true });
    const res = await api.find(payload.id);

    commit({ type: GET_USER, user: res.data.data });

    return res.data.data;
  } catch (err) {
    commit({ type: LOG_ERRORS, errors: err.response.data.message });
  }
};

export const createUser = async ({ commit }, payload) => {
  try {
    commit({ type: SET_SAVING, saving: true });
    await api.store({
      name: payload.name,
      email: payload.email,
      password: payload.password
    });

    commit({ type: SET_MESSAGE, message: "User created" });
    commit({ type: LOG_ERRORS, errors: null });
  } catch (err) {
    commit({ type: LOG_ERRORS, errors: err.response.data.message });
  }

  commit({ type: SET_SAVING, saving: false });
  setTimeout(() => commit({ type: SET_MESSAGE, message: null }), 5000);
};

export const updateUser = async ({ commit }, payload) => {
  try {
    commit({ type: SET_SAVING, saving: true });
    await api.update(payload.user.id, {
      name: payload.user.name,
      email: payload.user.email
    });

    commit({ type: SET_MESSAGE, message: "User updated" });
    commit({ type: LOG_ERRORS, errors: null });
  } catch (err) {
    commit({ type: LOG_ERRORS, errors: err.response.data.message });
  }

  commit({ type: SET_SAVING, saving: false });
  setTimeout(() => commit({ type: SET_MESSAGE, message: null }), 5000);
};

export const deleteUser = async ({ commit }, payload) => {
  try {
    commit({ type: SET_SAVING, saving: true });
    await api.delete(payload.user.id);

    commit({ type: SET_MESSAGE, message: "User deleted" });
  } catch (err) {
    commit({ type: LOG_ERRORS, errors: err.response.data.message });
  }

  commit({ type: SET_SAVING, saving: false });
  setTimeout(() => commit({ type: SET_MESSAGE, message: null }), 5000);
};
