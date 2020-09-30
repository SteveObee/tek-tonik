import {
  LOG_MESSAGE,
  CLEAR_MESSAGES,
  DELETE_MESSAGE
} from "../store/actions/types";
import store from "../store/index";

export const debounce = (fn, delay) => {
  var timeoutID = null;

  return function() {
    clearTimeout(timeoutID);
    var args = arguments;
    var that = this;
    timeoutID = setTimeout(function() {
      fn.apply(that, args);
    }, delay);
  };
};

export const search = (collection, query) => {
  let searchedCollection = [];

  collection.forEach(item => {
    const concatString = (item.name + " " + item.model).toLowerCase();

    if (concatString.includes(query.toLowerCase())) {
      searchedCollection.push(item);
    }
  });

  return searchedCollection;
};

export const messageHandler = (text, type, confirm = false) => {
  const id = generateUuid();

  store.commit({ type: LOG_MESSAGE, message: { text, type, id, confirm } });
  if (!confirm) {
    setTimeout(() => store.commit({ type: DELETE_MESSAGE, id }), 5000);
  }
};

export const generateUuid = () => {
  return ([1e7] + -1e3 + -4e3 + -8e3 + -1e11).replace(/[018]/g, c =>
    (
      c ^
      (crypto.getRandomValues(new Uint8Array(1))[0] & (15 >> (c / 4)))
    ).toString(16)
  );
};
