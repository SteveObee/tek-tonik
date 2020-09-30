import {
  getAllCategories,
  getAllRecursiveCategories,
  setSelectedCategory,
  getRecursiveCategoryIds
} from "../actions/category";

import {
  SET_CATEGORIES,
  SET_RECURSED_CATEGORIES,
  SET_SELECTED_CATEGORY,
  SET_RECURSIVE_IDS
} from "../mutations/category";

const state = {
  categories: null,
  recursedCategories: null,
  selectedCategory: { id: 2, name: "Electronics" },
  recursiveIds: null
};

const mutations = {
  SET_CATEGORIES,
  SET_RECURSED_CATEGORIES,
  SET_SELECTED_CATEGORY,
  SET_RECURSIVE_IDS
};

const actions = {
  getAllCategories,
  getAllRecursiveCategories,
  setSelectedCategory,
  getRecursiveCategoryIds
};

export default {
  state,
  actions,
  mutations
};
