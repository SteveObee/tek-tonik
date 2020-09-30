import axios from "axios";

export default {
  getKey() {
    return axios.get("/api/orders/stripekey");
  },
  get() {
    return axios.get("/api/users/orders");
  },
  charge(data) {
    return axios.post("/api/users/charge", data);
  },
  create(data) {
    return axios.post("api/orders/create", data);
  },
  add(data) {
    return axios.post("api/orders/additem", data);
  },
  update(id, data) {
    return axios.put(`/api/orders/${id}`, data);
  },
  delete(id) {
    return axios.delete(`/api/orders/${id}`);
  },
  confirmation(id) {
    return axios.get(`/api/orders/placed/${id}`);
  }
};
