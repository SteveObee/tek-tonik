<template>
  <div>
    <div v-if="loading">Loading...</div>

    <form @submit.prevent="onSubmit($event)" v-if="user">
      <div class="form-group">
        <label for="user_name">Name</label>
        <input id="user_name" v-model="user.name" /><span
          v-if="errors && errors.name"
          class="required"
        >
          {{ errors.name[0] }}
        </span>
      </div>
      <div class="form-group">
        <label for="user_email">Email</label>
        <input id="user_email" type="email" v-model="user.email" />
        <span v-if="errors && errors.email" class="required">
          {{ errors.email[0] }}
        </span>
      </div>
      <div class="form-group">
        <button type="submit" :disabled="saving">Update</button>
        <button :disabled="saving" @click.prevent="onDelete($event)">
          Delete
        </button>
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
import store from "../store/index";

export default {
  computed: {
    ...mapState({
      user: state => state.users.user,
      loading: state => state.users.loading,
      saving: state => state.users.saving,
      message: state => state.users.message,
      errors: state => state.users.errors
    })
  },
  methods: {
    ...mapActions(["getUser"]),
    async onSubmit(event) {
      await store.dispatch("updateUser", {
        user: this.user
      });

      if (!this.$store.state.users.errors) {
        this.$router.push({
          name: "users"
        });
      }
    },

    async onDelete(event) {
      await store.dispatch("deleteUser", {
        user: this.user
      });

      this.$router.push({
        name: "users"
      });
    },

    async getUser() {
      const user = await store.dispatch("getUser", {
        id: this.$route.params.id
      });

      if (!user) {
        this.$router.push({ name: "404" });
      }
    }
  },
  created() {
    this.getUser();
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
