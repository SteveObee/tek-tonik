import {
  getUsers,
  getUser,
  updateUser,
  deleteUser,
  createUser,
  contactAdmin
} from "../actions/admin";

import {
  GET_USER,
  GET_USERS,
  SET_LOADING,
  SET_MESSAGE,
  RESET_STATE
} from "../mutations/admin";

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
  SET_LOADING,
  SET_MESSAGE,
  RESET_STATE
};

const actions = {
  getUsers,
  getUser,
  updateUser,
  deleteUser,
  createUser,
  contactAdmin
};

export default {
  state,
  actions,
  mutations
};
