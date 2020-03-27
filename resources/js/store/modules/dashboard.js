import { increment, toggleAuth } from "../actions/dashboard";
import { INCREMENT, TOGGLE_AUTH } from "../mutations/dashboard";

const state = {
  count: 5,
  isAuthenticated: false
};

const mutations = {
  INCREMENT,
  TOGGLE_AUTH
};

const actions = { increment, toggleAuth };

export default {
  state,
  actions,
  mutations
};
