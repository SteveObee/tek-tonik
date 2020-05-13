import Dashboard from "../views/dashboard/Dashboard";
import DashProfile from "../views/dashboard/DashProfile.vue";
import DashAddresses from "../views/dashboard/DashAddresses.vue";
import DashPayment from "../views/dashboard/DashPayment.vue";
import DashSettings from "../views/dashboard/DashSettings.vue";

export default [
  {
    path: "/dashboard",
    // name: "dashboard",
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
        name: "dashboard.payment",
        path: "payment",
        component: DashPayment
      },
      {
        name: "dashboard.settings",
        path: "settings",
        component: DashSettings
      }
    ]
  }
];
