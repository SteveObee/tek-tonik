import Users from "./../views/admin/Users";
import UsersEdit from "./../views/admin/UsersEdit";
import UsersCreate from "./../views/admin/UsersCreate.vue";
import UsersLogin from "./../views/admin/UsersLogin.vue";

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
  },
  {
    path: "/users/login",
    name: "users.login",
    component: UsersLogin
  }
];
