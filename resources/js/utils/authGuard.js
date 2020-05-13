import store from "../store/index";

export const beforeResolve = (to, from, next) => {
  if (!store.state.auth.isAuthenticated) next({ name: "login" });
  else next();
};
