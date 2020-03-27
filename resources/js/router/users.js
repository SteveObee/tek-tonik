import Users from "./../views/Users";
import UsersEdit from "./../views/UsersEdit";
import UsersCreate from "./../views/UsersCreate.vue";
import store from "../store/index";

export default [
  {
    path: "/users",
    name: "users",
    component: Users
  },
  {
    path: "/users/:id/edit",
    name: "users.edit",
    component: UsersEdit
  },
  {
    path: "/users/create",
    name: "users.create",
    component: UsersCreate
  }
];
