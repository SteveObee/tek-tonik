import Vue from "vue";
import Vuex from "vuex";
import dashboard from "./modules/dashboard";
import admin from "./modules/admin";
import auth from "./modules/auth";
import address from "./modules/address";
import product from "./modules/product";
import basket from "./modules/basket";

Vue.use(Vuex);

export default new Vuex.Store({
  modules: { dashboard, admin, auth, address, product, basket }
});
