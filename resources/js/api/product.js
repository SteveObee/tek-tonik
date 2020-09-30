import axios from "axios";

export default {
  all(params) {
    return axios.get("/api/products", params);
  },
  find(id) {
    return axios.get(`/api/products/${id}`);
  },
  images(id, params) {
    return axios.get(`/api/products/${id}/images`, params);
  },
  getQuantity(id) {
    return axios.get(`/api/products/${id}/quantity`);
  },
  updateQuantity(id, data) {
    return axios.post(`/api/products/${id}/quantity`, data);
  },
  byCategory(id, params) {
    return axios.get(`/api/products/category/${id}`, params);
  },
  brands() {
    return axios.get("/api/brands");
  }
};
