import Vue from "vue";
import App from "./App";
import router from "./router";
import store from "./store/index";

store.dispatch("loadUser").then(() => {
  new Vue({
    el: "#app",
    router,
    store,
    render: h => h(App)
  });
});
