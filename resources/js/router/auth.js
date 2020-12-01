import Login from "./../views/auth/Login";
import Register from "./../views/auth/Register.vue";
import PasswordEmail from "./../views/auth/PasswordEmail.vue";
import PasswordReset from "./../views/auth/PasswordReset.vue";

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
    component: Register,
    props: true
  },
  {
    path: "/password/email",
    name: "password_email",
    title: "PasswordEmail",
    component: PasswordEmail
  },
  {
    path: "/password/reset/:token",
    name: "reset",
    title: "Reset",
    component: PasswordReset
  }
];
