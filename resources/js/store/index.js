import Vue from "vue";
import Vuex from "vuex";
import dashboard from "./modules/dashboard";
import admin from "./modules/admin";
import auth from "./modules/auth";
import address from "./modules/address";

Vue.use(Vuex);

export default new Vuex.Store({
  modules: { dashboard, admin, auth, address }
});
