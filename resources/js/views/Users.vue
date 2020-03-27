<template>
  <div class="users">
    <div class="loading" v-if="loading">
      Loading...
    </div>

    <div v-if="message" class="success">
      <p>{{ message }}</p>
    </div>

    <ul v-if="users">
      <li v-for="{ name, email, id } in users.data">
        <strong>Name:</strong>{{ name }} <strong>Email:</strong> {{ email }} |
        <span
          ><router-link :to="{ name: 'users.edit', params: { id } }"
            >Edit</router-link
          ></span
        >
      </li>
    </ul>

    <div class="pagination">
      <button :disabled="!prevPage" @click.prevent="goToPrev">Previous</button>
      {{ paginatonCount }}
      <button :disabled="!nextPage" @click.prevent="goToNext">Next</button>
    </div>
  </div>
</template>

<script>
import { mapActions, mapState } from "vuex";
import store from "../store/index";

export default {
  name: "Users",
  async beforeRouteEnter(to, from, next) {
    try {
      await store.dispatch("getUsers", { page: to.query.page });
      next();
    } catch (e) {
      next({
        name: "dashboard"
      });
    }
  },
  async beforeRouteUpdate(to, from, next) {
    try {
      await store.dispatch("getUsers", { page: to.query.page });
      next();
    } catch (e) {
      next({
        name: "dashboard"
      });
    }
  },
  computed: {
    ...mapState({
      users: state => state.users.users,
      links: state => state.users.users.links,
      meta: state => state.users.users.meta,
      loading: state => state.users.loading,
      error: state => state.users.errors,
      message: state => state.users.message
    }),
    nextPage() {
      if (!this.meta || this.meta.current_page === this.meta.last_page) {
        return;
      }

      return this.meta.current_page + 1;
    },
    prevPage() {
      if (!this.meta || this.meta.current_page === 1) {
        return;
      }

      return this.meta.current_page - 1;
    },
    paginatonCount() {
      if (!this.meta) {
        return;
      }

      const { current_page, last_page } = this.meta;

      return `${current_page} of ${last_page}`;
    }
  },
  methods: {
    ...mapActions(["getUsers"]),
    goToNext() {
      this.$router.push({
        query: {
          page: this.nextPage
        }
      });
    },
    goToPrev() {
      this.$router.push({
        name: "users",
        query: {
          page: this.prevPage
        }
      });
    }
  }
};
</script>
</script>
<style lang="scss" scoped>
$red: lighten(red, 30%);
$darkRed: darken($red, 50%);
$green: lighten(lightgreen, 10%);
$darkGreen: darken($green, 50%);
.form-group label {
  display: block;
}
.alert {
  background: $red;
  color: $darkRed;
  padding: 1rem;
  margin-bottom: 1rem;
  width: 50%;
  border: 1px solid $darkRed;
  border-radius: 5px;
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
