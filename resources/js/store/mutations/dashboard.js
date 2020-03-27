export const INCREMENT = state => {
  state.count++;
};

export const TOGGLE_AUTH = state => {
  state.isAuthenticated = !state.isAuthenticated;
};
