import { loginUser, loadUser, logoutUser, registerUser } from "../actions/auth";
import {
  LOGIN_USER,
  LOAD_USER,
  LOGOUT_USER,
  LOG_ERRORS,
  REGISTER_USER,
  SET_LOADING,
  SET_AUTHENTICATED
} from "../mutations/auth";

const state = {
  loading: true,
  isAuthenticated: null,
  user: null,
  errors: null
};

const mutations = {
  LOGIN_USER,
  LOAD_USER,
  LOGOUT_USER,
  LOG_ERRORS,
  REGISTER_USER,
  SET_LOADING,
  SET_AUTHENTICATED
};

const actions = { loginUser, loadUser, logoutUser, registerUser };

export default {
  state,
  actions,
  mutations
};
