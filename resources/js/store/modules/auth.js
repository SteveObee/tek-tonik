import {
  loginUser,
  loadUser,
  logoutUser,
  registerUser,
  resetPassword
} from "../actions/auth";
import {
  LOGIN_USER,
  LOAD_USER,
  LOGOUT_USER,
  REGISTER_USER,
  SET_LOADING,
  SET_SAVING,
  SET_AUTHENTICATED
} from "../mutations/auth";

const state = {
  loading: true,
  saving: false,
  isAuthenticated: null,
  user: { id: "Guest", name: "Guest" },
  errors: null
};

const mutations = {
  LOGIN_USER,
  LOAD_USER,
  LOGOUT_USER,
  REGISTER_USER,
  SET_LOADING,
  SET_SAVING,
  SET_AUTHENTICATED
};

const actions = {
  loginUser,
  loadUser,
  logoutUser,
  registerUser,
  resetPassword
};

export default {
  state,
  actions,
  mutations
};
