import {
  LOG_ERRORS,
  LOG_MESSAGE,
  DELETE_MESSAGE,
  CLEAR_MESSAGES
} from "../mutations/logging";

const state = {
  errors: null,
  messages: []
};

const mutations = { LOG_ERRORS, LOG_MESSAGE, DELETE_MESSAGE, CLEAR_MESSAGES };

const actions = {};

export default {
  state,
  actions,
  mutations
};
