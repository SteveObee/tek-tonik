<template>
  <form class="form-borderless t-center">
    <div class="t-center mb-2">
      <h3>{{ fullName }}</h3>
    </div>
    <h4 class="mb-1">Select Quantity</h4>
    <select v-if="product" class="mb-2" v-model="quantity">
      <option v-for="quantity in product.stock" v-bind:value="quantity">{{
        quantity
      }}</option>
    </select>

    <h4 class="mb-2">Select Color</h4>
    <p v-if="selectionHint" class="c-warning mb-2">Please select a color!</p>
    <div class="colors mb-2">
      <div
        class="color-value cu-point"
        :class="color.id == activeColor && 'cv-active'"
        v-for="color in colors"
        :style="{ 'background-color': color.value }"
        v-on:click="setColor(color.value, color.id)"
      ></div>
    </div>
    <div>
      <h4>Total: £{{ total }}</h4>
    </div>
    <button class="btn-primary mb-1" v-on:click.prevent="add()">
      <p><i class="fas fa-plus"></i> Add</p>
    </button>
  </form>
</template>

<script>
import { mapState, mapActions, mapMutations } from "vuex";
import store from "../../store/index";
import { messageHandler } from "../../utils/helpers";

export default {
  data() {
    return {
      color: null,
      activeColor: null,
      quantity: 1,
      selectionHint: false
    };
  },
  computed: {
    ...mapState({
      product: state => state.product.product,
      user: state => state.auth.user
    }),
    colors() {
      return this.product && this.product.colors;
    },
    fullName() {
      return this.product && this.product.name + " " + this.product.model;
    },
    total() {
      return this.product && (this.product.price * this.quantity).toFixed(2);
    }
  },
  methods: {
    ...mapActions(["getBasket", "addToBasket"]),
    ...mapMutations({
      toggle: "TOGGLE_MODAL"
    }),
    setColor(value, id) {
      this.color = value;
      this.activeColor = id;
    },
    async add() {
      const { name, description, id, thumbnail, model, price } = this.product;
      const { color, quantity, total } = this;

      const floatTotal = parseFloat(total);

      if (color) {
        const item = {
          userId: this.user.id,
          productId: this.product.id,
          name,
          description,
          thumbnail,
          model,
          brand: this.product.brand.name,
          quantity,
          color,
          price,
          total: floatTotal
        };

        await this.addToBasket(item);
        await this.getBasket(this.user.id);
        messageHandler("Item(s) added to basket", "success");
        await this.toggle();
      } else {
        this.selectionHint = true;
      }
    }
  }
};
</script>
