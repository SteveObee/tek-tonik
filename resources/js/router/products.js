import Products from "../views/products/Products";
import Product from "../views/products/Product.vue";

export default [
  {
    path: "/products",
    name: "products.index",
    title: "Products",
    component: Products
  },
  {
    path: "/products/:id",
    name: "products.page",
    component: Product
  }
];
