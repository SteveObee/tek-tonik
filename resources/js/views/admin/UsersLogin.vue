<template>
  <div>
    <a href="" @click.prevent="login">Login</a>
  </div>
</template>

<script>
import axios from "axios";

export default {
  methods: {
    async login() {
      await axios.get("http://localhost:3002/sanctum/csrf-cookie");
      await axios.post("http://localhost:3002/login", {
        email: "steve@steve.com",
        password: "12345678"
      });

      let response = await axios.get("http://localhost:3002/api/user");

      console.log(response.data);
    }
  }
};
</script>
