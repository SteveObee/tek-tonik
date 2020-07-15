<template>
  <div v-if="user" class="dash-profile">
    <div class="profile-group">
      <h5>Name</h5>
      <p>{{ user.name }}</p>
      <h5>Email</h5>
      <p>{{ user.email }}</p>
      <hr class="my-2" />
      <h5>Joined</h5>
      <p>{{ user.created_at }}</p>
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";

export default {
  computed: {
    ...mapState({
      user: state => state.auth.user
    })
  }
};
</script>
