import axios from "axios";

export default {
  all(params) {
    return axios.get("/api/users", params);
  },
  store(data) {
    return axios.post("/api/users", data);
  },
  find(id) {
    return axios.get(`/api/users/${id}`);
  },
  update(id, data) {
    return axios.put(`/api/users/${id}`, data);
  },
  delete(id) {
    return axios.delete(`/api/users/${id}`);
  },
  contact(data) {
    return axios.post("/api/admin/contact", data);
  }
};
