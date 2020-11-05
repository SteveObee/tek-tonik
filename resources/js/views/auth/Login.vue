<template>
  <div id="register">
    <h1 class="mb-2 xxl text-center"><i class="fas fa-lock"></i> Login</h1>
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
          <small>{{ errors.email[0] }}</small>
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
          <small>{{ errors.password[0] }}</small>
        </div>
      </div>
      <button type="submit" class="btn-primary">Submit</button>
    </form>

    <div class="text-center">
      <small
        >Not a member yet?,
        <router-link :to="{ name: 'register' }" class="c-primary">
          Sign up here</router-link
        ></small
      >
    </div>
  </div>
</template>

<script>
import { mapActions, mapState } from "vuex";
import store from "../../store/index";

export default {
  data() {
    return {
      email: "",
      password: ""
    };
  },
  computed: {
    ...mapState({
      errors: state => state.logging.errors
    })
  },
  methods: {
    async onSubmit(event) {
      await store.dispatch("loginUser", {
        email: this.email,
        password: this.password
      });

      if (!this.errors) {
        await store.commit({ type: "EMPTY_BASKET" });
        await store.dispatch("loadUser");
        await store.dispatch("getBasket", this.$store.state.auth.user.id);

        this.$router.push({
          name: "products.index"
        });
      }
    }
  }
};
</script>
