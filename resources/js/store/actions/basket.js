import { POPULATE_BASKET, EMPTY_BASKET, LOG_ERRORS, SET_TOTAL } from "./types";

import api from "../../api/basket";
import store from "../index";
import { messageHandler } from "../../utils/helpers";

export const getBasket = async ({ commit }, userId) => {
  try {
    const basketName = "basket_" + userId;
    const data = await JSON.parse(localStorage.getItem(basketName));

    if (data) {
      store.dispatch("setTotal", data.items);
      commit({ type: POPULATE_BASKET, basket: data });
    } else {
      commit({ type: SET_TOTAL, total: 0 });
    }
  } catch (err) {
    commit({ type: LOG_ERRORS, errors: err.response.data.message });
  }
};

export const emptyBasket = async ({ commit }, payload) => {
  try {
    const { userId, messageText, messageType } = payload;

    const basketName = "basket_" + payload.userId;

    await localStorage.removeItem(basketName);

    commit({ type: EMPTY_BASKET });
    if (messageText && messageType) {
      messageHandler(messageText, messageType);
    }
  } catch (err) {
    commit({ type: LOG_ERRORS, errors: err.response.data.message });
  }
};

export const addToBasket = async ({ commit }, item) => {
  try {
    // Create basket name and assign to variable
    const basketName = "basket_" + item.userId;
    let basket = JSON.parse(localStorage.getItem(basketName));

    // If no basket create
    if (!basket) {
      basket = {
        items: [],
        nextId: 1
      };
    }

    // Assign next item name
    const newItemName = "item_" + basket.nextId;

    // Get current date and time to store with item
    const currentTime = new Date();
    const currentTimestamp = currentTime.toUTCString();

    // Assign id's to items
    const newId = basket.nextId;
    basket.nextId++;

    // Construct item
    const newItem = {
      id: newId,
      productId: item.productId,
      name: item.name,
      description: item.description,
      thumbnail: item.thumbnail,
      model: item.model,
      brand: item.brand,
      quantity: item.quantity,
      color: item.color,
      price: item.price,
      total: item.total,
      priceDiff: null,
      prevUpdatedAt: null,
      updatedAt: currentTimestamp
    };

    // Add new item to basket
    basket.items.push(newItem);

    // Save basket to local storage
    localStorage.setItem(basketName, JSON.stringify(basket));
  } catch (err) {
    commit({ type: LOG_ERRORS, errors: err.response.data.message });
  }
};

export const updateBasket = async ({ commit }, payload) => {
  try {
    const { basket, nextId, messageText, messageType } = payload;

    const basketName = "basket_" + payload.userId;

    let newBasket = {};

    newBasket["items"] = basket;
    newBasket["nextId"] = nextId;

    localStorage.setItem(basketName, JSON.stringify(newBasket));
    if (messageText && messageType) {
      messageHandler(messageText, messageType);
    }
  } catch (err) {
    commit({ type: LOG_ERRORS, errors: err.response.data.message });
  }
};

export const setTotal = async ({ commit }, payload) => {
  try {
    let total;

    if (payload) {
      total = payload
        .map(item => item.total)
        .reduce((a, b) => {
          return a + b;
        });
    } else {
      total = 0;
    }

    commit({ type: SET_TOTAL, total });
  } catch (err) {
    console.error(err);
  }
};
