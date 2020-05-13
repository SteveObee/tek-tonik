import axios from "axios";

export default {
  csrf() {
    return axios.get("http://localhost:3002/sanctum/csrf-cookie");
  },
  login(data) {
    return axios.post("http://localhost:3002/login", data);
  },
  logout() {
    return axios.post("http://localhost:3002/logout");
  },
  register(data) {
    return axios.post("http://localhost:3002/register", data);
  },
  load() {
    return axios.get("http://localhost:3002/api/user");
  }
};
