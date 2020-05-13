import { increment } from "../actions/dashboard";
import { INCREMENT } from "../mutations/dashboard";

const state = {
  count: 5
};

const mutations = {
  INCREMENT
};

const actions = { increment };

export default {
  state,
  actions,
  mutations
};
