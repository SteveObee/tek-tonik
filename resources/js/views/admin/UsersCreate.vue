<template>
  <div>
    <div v-if="message">{{ message }}</div>
    <div v-if="loading">Loading...</div>

    <form @submit.prevent="onSubmit($event)">
      <div class="form-group">
        <label for="user_name">Name</label>
        <input id="user_name" v-model="name" /><span
          v-if="errors && errors.name"
          class="required"
        >
          {{ errors.name[0] }}
        </span>
      </div>
      <div class="form-group">
        <label for="user_email">Email</label>
        <input id="user_email" type="email" v-model="email" />
        <span v-if="errors && errors.email" class="required">
          {{ errors.email[0] }}
        </span>
      </div>
      <div class="form-group">
        <label for="user_password">Password</label>
        <input id="user_password" type="password" v-model="password" />
        <span v-if="errors && errors.password" class="required">
          {{ errors.password[0] }}
        </span>
      </div>
      <div class="form-group">
        <button type="submit" :disabled="saving">Create User</button>
      </div>
      <div class="form-group">
        <router-link :to="{ name: 'users' }"><button>Back</button></router-link>
      </div>
      <div class="form-group"></div>
    </form>
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
      password: ""
    };
  },
  computed: {
    ...mapState({
      // user: state => state.users.user,
      loading: state => state.admin.loading,
      saving: state => state.auth.saving,
      message: state => state.admin.message,
      errors: state => state.admin.errors
    })
  },
  methods: {
    async onSubmit(event) {
      await store.dispatch("createUser", {
        name: this.name,
        email: this.email,
        password: this.password
      });

      if (!this.errors) {
        this.$router.push({
          name: "users"
        });
      }
    }
  }
};
</script>

<style lang="scss" scoped>
$red: lighten(red, 30%);
$darkRed: darken($red, 50%);
$green: lighten(lightgreen, 10%);
$darkGreen: darken($green, 50%);
.form-group {
  display: block;
  padding: 0.5rem 0;
}
.required {
  color: red;
  padding-left: 0.5rem;
}

.success {
  background: $green;
  color: $darkGreen;
  padding: 1rem;
  margin-bottom: 1rem;
  width: 50%;
  border: 1px solid $darkGreen;
  border-radius: 5px;
}
</style>
