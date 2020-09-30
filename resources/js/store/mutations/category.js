export const SET_CATEGORIES = (state, payload) => {
  state.categories = payload.categories;
};

export const SET_RECURSED_CATEGORIES = (state, payload) => {
  state.recursedCategories = payload.categories;
};

export const SET_SELECTED_CATEGORY = (state, payload) => {
  state.selectedCategory = payload.selectedCategory;
};

export const SET_RECURSIVE_IDS = (state, payload) => {
  state.recursiveIds = payload.recursiveIds;
};
