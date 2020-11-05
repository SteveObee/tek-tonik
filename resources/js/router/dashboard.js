import Dashboard from "../views/dashboard/Dashboard";
import DashProfile from "../views/dashboard/DashProfile.vue";
import DashAddresses from "../views/dashboard/DashAddresses.vue";
import DashOrders from "../views/dashboard/DashOrders.vue";
import DashSettings from "../views/dashboard/DashSettings.vue";
import store from "../store/index";

export default [
  {
    path: "/dashboard",
    name: "dashboard",
    title: "Dashboard",
    component: Dashboard,
    beforeEnter: (to, from, next) => {
      !store.state.auth.isAuthenticated ? next({ name: "login" }) : next();
    },
    children: [
      {
        name: "dashboard.profile",
        path: "profile",
        component: DashProfile
      },
      {
        name: "dashboard.addresses",
        path: "addresses",
        component: DashAddresses
      },
      {
        name: "dashboard.orders",
        path: "orders",
        component: DashOrders
      },
      {
        name: "dashboard.settings",
        path: "settings",
        component: DashSettings
      }
    ]
  }
];
