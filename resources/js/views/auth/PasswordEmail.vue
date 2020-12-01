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
        <p class="mb-2 w-250 c-grey-50 m-auto">
          Please enter your email below and we will send you a password reset
          link.
        </p>
        <label for="email">Email</label>
        <input
          type="email"
          id="email"
          placeholder="Enter email"
          required
          autocomplete="new-email"
          v-model="email"
        />
        <div v-if="errors && errors.email" class="required m-auto mt-1">
          <small>{{ errors.email[0] }}</small>
        </div>
      </div>
      <Spinner v-if="loading" />
      <button v-else type="submit" class="btn-primary">Submit</button>
    </form>
  </div>
</template>

<script>
import axios from "axios";
import { mapActions, mapState } from "vuex";
import store from "../../store/index";
import { messageHandler } from "../../utils/helpers";
import Spinner from "../Spinner";

export default {
  components: {
    Spinner
  },
  data() {
    return {
      email: "",
      errors: null,
      loading: false
    };
  },
  methods: {
    async onSubmit(event) {
      try {
        this.loading = true;
        const res = await axios.post("/password/email", { email: this.email });
        this.errors = null;
        this.loading = false;

        messageHandler(res.data.message, "success");
      } catch (err) {
        this.loading = false;
        this.errors = err.response.data.message;
      }
    }
  }
};
</script>
