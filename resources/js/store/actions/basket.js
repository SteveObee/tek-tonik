import { POPULATE_BASKET, EMPTY_BASKET, LOG_ERRORS } from "./types";

import api from "../../api/basket";

export const getBasket = async ({ commit }, userId) => {
  try {
    const basketName = "basket_" + userId;
    const data = JSON.parse(localStorage.getItem(basketName));

    if (data) {
      commit({ type: POPULATE_BASKET, basket: data });
    }
  } catch (err) {
    commit({ type: LOG_ERRORS, errors: err.response.data.message });
  }
};

export const emptyBasket = async ({ commit }) => {
  try {
    commit({ type: EMPTY_BASKET });
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
    const basketName = "basket_" + payload.userId;

    let basket = {};

    basket["items"] = payload.basket;
    basket["nextId"] = payload.nextId;

    localStorage.setItem(basketName, JSON.stringify(basket));
  } catch (err) {
    commit({ type: LOG_ERRORS, errors: err.response.data.message });
  }
};
