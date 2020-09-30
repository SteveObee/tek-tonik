export const LOG_ERRORS = (state, payload) => {
  state.errors = payload.errors;
};

export const LOG_MESSAGE = (state, payload) => {
  state.messages.push(payload.message);
};

export const CLEAR_MESSAGES = state => {
  state.messages = [];
};

export const DELETE_MESSAGE = (state, payload) => {
  state.messages = state.messages.filter(message => message.id !== payload.id);
};
