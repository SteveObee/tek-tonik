<template>
  <div id="register">
    <p v-if="checkingOut" class="c-warning mb-2">
      ! Please register to proceed with purchase
    </p>
    <h1 class="xxl text-center mb-2">
      <i class="fas fa-user-plus"></i> Register
    </h1>
    <form
      @submit.prevent="onSubmit($event)"
      class="form register-form"
      novalidate
    >
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
      <button type="submit" class="btn-primary">Submit</button>
    </form>
  </div>
</template>

<script>
import { mapActions, mapState } from "vuex";
import store from "../../store/index";

export default {
  props: {
    checkingOut: {
      type: Boolean
    }
  },
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
      errors: state => state.logging.errors,
      basket: state => state.basket.basket,
      nextId: state => state.basket.nextId,
      user: state => state.auth.user
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

        if (this.checkingOut) {
          await store.dispatch("updateBasket", {
            basket: this.basket,
            userId: this.user.id,
            nextId: this.nextId
          });

          await store.dispatch("emptyBasket", { userId: "Guest" });

          this.$router.push({
            name: "order.payment"
          });
        } else {
          this.$router.push({
            name: "dashboard.profile"
          });
        }
      }
    }
  }
};
</script>
