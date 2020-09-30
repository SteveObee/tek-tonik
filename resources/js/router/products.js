import ProductsPage from "../views/products/ProductsPage";
import Product from "../views/products/Product.vue";

export default [
  {
    path: "/products",
    name: "products.index",
    title: "ProductsPage",
    component: ProductsPage
  },
  {
    path: "/products/:id",
    name: "products.page",
    component: Product
  }
];
