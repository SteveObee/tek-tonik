import axios from "axios";

export default {
  csrf() {
    return axios.get("/sanctum/csrf-cookie");
  },
  login(data) {
    return axios.post("/login", data);
  },
  logout() {
    return axios.post("/logout");
  },
  register(data) {
    return axios.post("/register", data);
  },
  load() {
    return axios.get("/api/user");
  },
  reset(data) {
    return axios.post("/password/reset", data);
  }
};
