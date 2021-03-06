import Vue from "vue";
import Router from "vue-router";
import usersRoutes from "./admin";
import dashboardRoutes from "./dashboard";
import authRoutes from "./auth";
import productRoutes from "./products";
import basketRoutes from "./basket";
import orderRoutes from "./order";
import contactRoutes from "./contact";

import Login from "./../views/auth/Login";
import NotFound from "../views/NotFound.vue";

import store from "../store/index";

Vue.use(Router);

const baseRoutes = [
  { path: "/", redirect: "/products" },
  { path: "/404", name: "404", component: NotFound },
  {
    path: "*",
    redirect: "/404"
  }
];

const routes = baseRoutes.concat(
  authRoutes,
  usersRoutes,
  dashboardRoutes,
  productRoutes,
  basketRoutes,
  orderRoutes,
  contactRoutes
);

const router = new Router({
  mode: "history",
  routes
});

export default router;
