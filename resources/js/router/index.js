import Vue from "vue";
import Router from "vue-router";
import usersRoutes from "./admin";
import dashboardRoutes from "./dashboard";
import authRoutes from "./auth";

import Login from "./../views/auth/Login";
import NotFound from "../views/NotFound.vue";

import store from "../store/index";

Vue.use(Router);

const baseRoutes = [
  { path: "/", redirect: "/dashboard/profile" },
  { path: "/404", name: "404", component: NotFound },
  {
    path: "*",
    redirect: "/404"
  }
];

const routes = baseRoutes.concat(authRoutes, usersRoutes, dashboardRoutes);

const router = new Router({
  mode: "history",
  routes
});

router.beforeEach((to, from, next) => {
  if (to.name !== "login" && !store.state.auth.isAuthenticated) {
    next({ name: "login" });
  } else next();
});

export default router;
