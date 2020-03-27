import Vue from "vue";
import Router from "vue-router";
import usersRoutes from "./users";
import dashboardRoutes from "./dashboard";
import NotFound from "../views/NotFound.vue";

Vue.use(Router);

const baseRoutes = [
  { path: "/404", name: "404", component: NotFound },
  {
    path: "*",
    redirect: "/404"
  }
];

const routes = baseRoutes.concat(usersRoutes, dashboardRoutes);

export default new Router({
  mode: "history",
  routes
});
