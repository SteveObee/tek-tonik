import axios from "axios";

export default {
  all() {
    return axios.get("/api/categories");
  },
  allRecursed() {
    return axios.get("/api/categories/recursed");
  },
  recursive(id) {
    return axios.get(`/api/categories/${id}`);
  }
};
