import Dashboard from "../views/dashboard/Dashboard";
import DashProfile from "../views/dashboard/DashProfile.vue";
import DashAddresses from "../views/dashboard/DashAddresses.vue";
import DashOrders from "../views/dashboard/DashOrders.vue";
import DashSettings from "../views/dashboard/DashSettings.vue";

export default [
  {
    path: "/dashboard",
    name: "dashboard",
    title: "Dashboard",
    component: Dashboard,
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
