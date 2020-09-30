import {
  getUserAddresses,
  getAllUserAddresses,
  addAddress,
  deleteAddress,
  updateAddress,
  resetErrors
} from "../actions/address";
import { GET_ADDRESSES, SET_MESSAGE } from "../mutations/address";

const state = {
  addresses: null,
  loading: true,
  message: null,
  errors: null
};

const mutations = {
  GET_ADDRESSES,
  SET_MESSAGE
};

const actions = {
  getUserAddresses,
  getAllUserAddresses,
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
