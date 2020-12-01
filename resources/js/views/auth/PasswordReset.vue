<template>
  <div id="register">
    <h1 class="mb-2 xxl text-center">
      <i class="fas fa-key"></i> Reset Password
    </h1>
    <form
      @submit.prevent="onSubmit($event)"
      class="form login-form mb-1"
      novalidate
    >
      <div class="form-control text-center">
        <label for="email">Email</label>
        <input
          type="email"
          id="email"
          placeholder="Enter email"
          required
          autocomplete="new-email"
          v-model="email"
        />
        <div v-if="errors && errors.email" class="required">
          <small v-for="error in errors.email" class="mb-1"
            >{{ error }}<br class="mb-1"
          /></small>
        </div>
      </div>
      <div class="form-control text-center">
        <label for="password">Password</label>
        <input
          type="password"
          id="password"
          placeholder="Enter password"
          required
          autocomplete="new-password"
          v-model="password"
        />
        <div v-if="errors && errors.password" class="required">
          <small v-for="error in errors.password" class=""
            >{{ error }}<br class="mb-1"
          /></small>
        </div>
      </div>
      <div class="form-control text-center">
        <label for="password">Confirm Password</label>
        <input
          type="password"
          id="password-confirm"
          placeholder="Confirm password"
          required
          autocomplete="new-password"
          v-model="passwordConfirm"
        />
      </div>
      <button type="submit" class="btn-primary">Submit</button>
    </form>
  </div>
</template>

<script>
import axios from "axios";
import { mapActions, mapState } from "vuex";
import store from "../../store/index";

export default {
  data() {
    return {
      email: "",
      password: "",
      passwordConfirm: "",
      token: null
    };
  },
  mounted() {
    this.email = this.$route.query.email;
    this.token = this.$route.params.token;
  },
  computed: {
    ...mapState({
      errors: state => state.logging.errors,
      user: state => state.auth.user
    })
  },

  methods: {
    ...mapActions(["resetPassword", "loginUser"]),
    async onSubmit(event) {
      const { email, password, passwordConfirm, token } = this;

      await this.resetPassword({ email, password, passwordConfirm, token });

      if (!this.errors) {
        await this.loginUser({ email, password });
        await store.commit({ type: "EMPTY_BASKET" });
        await store.dispatch("loadUser");
        await store.dispatch("getBasket", this.user.id);

        this.$router.push({
          name: "products.index"
        });
      }
    }
  }
};
</script>
