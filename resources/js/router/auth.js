import Login from "./../views/auth/Login";
import Register from "./../views/auth/Register.vue";

export default [
  {
    path: "/login",
    name: "login",
    title: "Login",
    component: Login
  },
  {
    path: "/register",
    name: "register",
    title: "Register",
    component: Register
  }
];
