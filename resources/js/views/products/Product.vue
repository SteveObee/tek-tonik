<template>
  <div id="product">
    <NavButton v-bind:type="'back'" class="mb-1" />
    <div class="product-grid">
      <div class="item-title">
        {{ product.brand.name }} {{ product.name }} {{ product.model }} ({{
          color
        }}, {{ product.created_at.slice(0, 4) }})
      </div>
      <div class="item-right">
        <div class="pricing mb-3">
          <h3 class="c-price">£{{ product.price }}</h3>
          <h4
            v-if="product.stock"
            v-bind:class="product.stock > 10 ? 'c-success' : 'c-warning'"
          >
            {{ product.stock }} in stock
          </h4>
          <h4 v-else class="c-danger">
            Out of stock
          </h4>
        </div>
        <div class="colors mb-2">
          <div
            class="color-value cu-point"
            :class="color.id == activeColor && 'cv-active'"
            v-for="color in product.colors"
            :style="{ 'background-color': color.value }"
            v-on:click="setColor(color.value, color.id)"
          ></div>
        </div>
        <div class="quantity mb-2">
          <p>Quantity</p>
          <div class="quantity-count">
            <button v-on:click="decQuantity()">
              <i class="fas fa-minus"></i>
            </button>
            <div class="quantity-number">
              <p>{{ quantity }}</p>
            </div>
            <button v-on:click="incQuantity()">
              <i class="fas fa-plus"></i>
            </button>
          </div>
        </div>
        <div class="product-buttons">
          <button class="btn-primary basket-add" v-on:click="addToBasket()">
            <p><i class="fas fa-plus"></i> Add to basket</p>
          </button>
          <transition name="slide">
            <div class="basket-added" v-if="added">
              <p><i class="far fa-check-circle"></i> Added</p>
            </div>
          </transition>
        </div>
        <div
          v-if="user && addresses.length > 0"
          class="product-address my-2 cu-point"
        >
          <i class="fas fa-map-marker-alt"></i> Deliver to {{ user.name }},
          {{ addresses[0].city }}, {{ addresses[0].postcode }}
        </div>
        <div
          v-else-if="user && addresses.length == 0"
          class="product-address my-2 cu-point"
        >
          <router-link :to="{ name: 'dashboard.addresses' }"
            ><i class="fas fa-map-marker-alt"></i> Add address</router-link
          >
        </div>
      </div>
      <div class="item-image">
        <img :src="mainImage" alt="Main product image" />
      </div>
      <div class="item-gallery" v-if="images">
        <button
          class="gallery-container btn-light"
          @click.prevent="prevPage"
          :disabled="!images.links.prev"
        >
          <i class="fas fa-chevron-left"></i>
        </button>
        <div
          class="gallery-container"
          v-for="image in images.data"
          v-on:click="setMainImage(image.url)"
        >
          <img :src="image.url" alt="Product image" />
        </div>
        <button
          class="gallery-container btn-light"
          @click.prevent="nextPage"
          :disabled="!images.links.next"
        >
          <i class="fas fa-chevron-right"></i>
        </button>
      </div>
      <div class="item-body my-3">
        <h2 class="mb-1">Description</h2>
        <p>{{ product.description }}</p>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState, mapActions } from "vuex";
import store from "../../store/index";
import NavButton from "../layout/NavButton";

export default {
  components: {
    NavButton
  },
  data() {
    return {
      mainImage: "",
      color: "",
      activeColor: "",
      quantity: 1,
      added: false
    };
  },
  async beforeRouteEnter(to, from, next) {
    try {
      await store.dispatch("getProduct", to.params.id);
      await store.dispatch("getAllUserAddresses");
      await store.dispatch("getImages", { id: to.params.id, page: 1 });
      next(vm => {
        vm.mainImage = vm.images.data[0].url;
        vm.color = vm.product.colors[0].value;
        vm.activeColor = vm.product.colors[0].id;
      });
    } catch (e) {
      next({
        name: "products.index"
      });
    }
  },
  methods: {
    ...mapActions([
      "getProduct",
      "getImages",
      "getAllUserAddresses",
      "addToBasket"
    ]),
    async prevPage() {
      const prevPageId = this.images.meta.current_page - 1;

      await store.dispatch("getImages", {
        id: this.product.id,
        page: prevPageId
      });
    },
    async nextPage() {
      const nextPageId = this.images.meta.current_page + 1;

      await store.dispatch("getImages", {
        id: this.product.id,
        page: nextPageId
      });
    },
    setMainImage(url) {
      this.mainImage = url;
    },
    setColor(value, id) {
      this.color = value;
      this.activeColor = id;
    },
    incQuantity() {
      if (this.quantity < this.product.stock) {
        this.quantity += 1;
      }
    },
    decQuantity() {
      if (this.quantity > 1) {
        this.quantity -= 1;
      }
    },
    async addToBasket() {
      this.added = true;

      setTimeout(() => {
        this.added = false;
      }, 2000);

      const sumTotal = parseFloat(
        (this.product.price * this.quantity).toFixed(2)
      );

      const item = {
        userId: this.user.id,
        productId: this.product.id,
        name: this.product.name,
        description: this.product.description,
        thumbnail: this.product.thumbnail,
        model: this.product.model,
        brand: this.product.brand.name,
        quantity: this.quantity,
        color: this.color,
        price: this.product.price,
        total: sumTotal
      };

      await store.dispatch("addToBasket", item);
      await store.dispatch("getBasket", this.user.id);
    }
  },
  computed: {
    ...mapState({
      user: state => state.auth.user,
      product: state => state.product.product,
      images: state => state.product.images,
      addresses: state => state.address.addresses,
      basket: state => state.basket.basket
    })
  }
};
</script>
