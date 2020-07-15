import axios from "axios";

export default {
  all() {
    return axios.get("/api/products");
  },
  find(id) {
    return axios.get(`/api/products/${id}`);
  },
  images(id, params) {
    return axios.get(`/api/products/${id}/images`, params);
  }
};
