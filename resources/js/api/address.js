import axios from "axios";

export default {
  user(params) {
    return axios.get("/api/users/addresses", params);
  },
  all() {
    return axios.get("/api/users/addresses/all");
  },
  add(data) {
    return axios.post("/api/addresses", data);
  },
  delete(id) {
    return axios.delete(`/api/addresses/${id}`);
  }
};
