import {
  getUsers,
  getUser,
  updateUser,
  deleteUser,
  createUser
} from "../actions/users";

import {
  GET_USER,
  GET_USERS,
  LOG_ERRORS,
  SET_LOADING,
  SET_SAVING,
  SET_MESSAGE,
  RESET_STATE
} from "../mutations/users";

const state = {
  users: null,
  user: null,
  errors: null,
  message: null,
  loading: false,
  saving: false
};

const mutations = {
  GET_USER,
  GET_USERS,
  LOG_ERRORS,
  SET_LOADING,
  SET_SAVING,
  SET_MESSAGE,
  RESET_STATE
};

const actions = { getUsers, getUser, updateUser, deleteUser, createUser };

export default {
  state,
  actions,
  mutations
};
