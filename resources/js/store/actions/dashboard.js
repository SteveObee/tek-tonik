import { INCREMENT, TOGGLE_AUTH } from "./types";

export const increment = ({ commit }) => {
  commit(INCREMENT);
};

export const toggleAuth = ({ commit }) => {
  commit(TOGGLE_AUTH);
};
