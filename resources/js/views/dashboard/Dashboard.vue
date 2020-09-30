<template>
  <div id="dashboard">
    <h2 class="section-title mb-1">Dashboard</h2>

    <div class="dashboard-content">
      <div class="dashboard-sidebar">
        <ul>
          <router-link class="list-item" :to="{ name: 'dashboard.profile' }"
            >Profile</router-link
          >
          <router-link class="list-item" :to="{ name: 'dashboard.addresses' }"
            >Addresses</router-link
          >
          <router-link class="list-item" :to="{ name: 'dashboard.orders' }"
            >Orders</router-link
          >
          <router-link class="list-item" :to="{ name: 'dashboard.settings' }"
            >Settings</router-link
          >
        </ul>
      </div>
      <div class="content">
        <router-view></router-view>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from "vuex";

export default {
  name: "Dashboard"
};
</script>
