import Vue from "vue";
import Vuex from "vuex";
import dashboard from "./modules/dashboard";
import category from "./modules/category";
import admin from "./modules/admin";
import auth from "./modules/auth";
import address from "./modules/address";
import product from "./modules/product";
import basket from "./modules/basket";
import order from "./modules/order";
import logging from "./modules/logging";
import layout from "./modules/layout";

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    dashboard,
    admin,
    auth,
    address,
    product,
    basket,
    category,
    order,
    logging,
    layout
  }
});
