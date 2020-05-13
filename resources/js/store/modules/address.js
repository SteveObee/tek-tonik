import {
  getUserAddresses,
  addAddress,
  deleteAddress,
  updateAddress,
  resetErrors
} from "../actions/address";
import {
  GET_ADDRESSES,
  LOG_ERRORS,
  SET_SAVING,
  SET_MESSAGE
} from "../mutations/address";

const state = {
  addresses: null,
  loading: true,
  message: null,
  errors: null
};

const mutations = {
  GET_ADDRESSES,
  LOG_ERRORS,
  SET_SAVING,
  SET_MESSAGE
};

const actions = {
  getUserAddresses,
  addAddress,
  deleteAddress,
  updateAddress,
  resetErrors
};

export default {
  state,
  actions,
  mutations
};
