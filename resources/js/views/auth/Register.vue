<template>
  <div id="login">
    <div class="login-form">
      <form @submit.prevent="onSubmit($event)" class="form">
        <h1 class="my-1 xxl text-center">
          <i class="fas fa-user-plus"></i> Register
        </h1>
        <div class="form-control text-center">
          <label for="name">Name</label>
          <input
            type="text"
            id="name"
            required
            autocomplete="new-name"
            placeholder="Enter name"
            v-model="name"
          />
          <div v-if="errors && errors.name" class="required">
            <small>{{ errors.name[0] }}</small>
          </div>
        </div>
        <div class="form-control text-center">
          <label for="email">Email</label>
          <input
            type="text"
            id="email"
            required
            autocomplete="new-email"
            placeholder="Enter email"
            v-model="email"
          />
          <div v-if="errors && errors.email" class="required">
            <small>{{ errors.email[0] }}</small>
          </div>
        </div>
        <div class="form-control text-center">
          <label for="password">Password</label>
          <input
            type="password"
            id="password"
            required
            autocomplete="new-password"
            placeholder="Enter password"
            v-model="password"
          />
          <div v-if="errors && errors.password" class="required">
            <small>{{ errors.password[0] }}</small>
          </div>
        </div>
        <div class="form-control text-center">
          <label for="password2">Confirm Password</label>
          <input
            type="password"
            name="password_confirmation"
            required
            autocomplete="new-password"
            placeholder="Retype password"
            v-model="password_confirmation"
          />
        </div>
        <button type="submit" class="btn-light">Submit</button>
      </form>
    </div>
  </div>
</template>

<script>
import { mapActions, mapState } from "vuex";
import store from "../../store/index";

export default {
  data() {
    return {
      name: "",
      email: "",
      password: "",
      password_confirmation: ""
    };
  },
  computed: {
    ...mapState({
      errors: state => state.auth.errors
    })
  },
  methods: {
    async onSubmit(event) {
      await store.dispatch("registerUser", {
        name: this.name,
        email: this.email,
        password: this.password,
        password_confirmation: this.password_confirmation
      });

      if (!this.errors) {
        await store.dispatch("loadUser");

        this.$router.push({
          name: "dashboard"
        });
      }
    }
  }
};
</script>
