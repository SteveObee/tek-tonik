import axios from "axios";

export default {
  user(params) {
    return axios.get("http://localhost:3002/api/users/addresses", params);
  },
  all() {
    return axios.get("http://localhost:3002/api/users/addresses/all");
  },
  add(data) {
    return axios.post("http://localhost:3002/api/addresses", data);
  },
  delete(id) {
    return axios.delete(`http://localhost:3002/api/addresses/${id}`);
  }
};
