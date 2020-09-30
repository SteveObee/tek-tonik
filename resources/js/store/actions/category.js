import {
  SET_CATEGORIES,
  SET_SELECTED_CATEGORY,
  SET_RECURSIVE_IDS,
  SET_RECURSED_CATEGORIES
} from "./types";
import api from "../../api/category";

export const getAllCategories = async ({ commit }) => {
  try {
    const res = await api.all();

    commit({ type: SET_CATEGORIES, categories: res.data });
  } catch (err) {
    console.log(err);
  }
};

export const getAllRecursiveCategories = async ({ commit }) => {
  try {
    const res = await api.allRecursed();

    commit({ type: SET_RECURSED_CATEGORIES, categories: res.data });
  } catch (err) {
    console.log(err);
  }
};

export const setSelectedCategory = async ({ commit }, payload) => {
  try {
    commit({ type: SET_SELECTED_CATEGORY, selectedCategory: payload });
  } catch (err) {
    console.log(err);
  }
};

export const getRecursiveCategoryIds = async ({ commit }, payload) => {
  try {
    const res = await api.recursive(payload);

    commit({ type: SET_RECURSIVE_IDS, recursiveIds: res.data });
  } catch (err) {
    console.log(err);
  }
};
