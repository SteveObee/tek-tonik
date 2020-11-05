export const GET_PRODUCTS = (state, payload) => {
  state.products = payload.products;
  state.loading = false;
};

export const SET_IMAGES = (state, payload) => {
  state.images = payload.images;
  state.loading = false;
};

export const CLEAR_IMAGES = state => {
  state.images = null;
  state.loading = false;
};

export const GET_PRODUCT = (state, payload) => {
  state.product = payload.product;
  state.loading = false;
};

export const SET_PRODUCT_LOADING = (state, payload) => {
  state.loading = payload.loading;
};

export const SET_SEARCHING = (state, payload) => {
  state.searching = payload.searching;
};

export const SET_SEARCH_QUERY = (state, payload) => {
  state.searchQuery = payload.searchQuery;
};

export const SET_BRANDS = (state, payload) => {
  state.productBrands = payload.brands;
};
