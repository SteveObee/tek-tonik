# E-comm app

## Business rules

1. Scope

- A Product Hierarchy has been assumed, where each Product has just one Parent Product.

2. The Things of Interest

- Customers
- Orders
- Payment Methods
- Products
- Shipments
- Suppliers
- Addresses

3. Relationships

- A CUSTOMER can have multiple adresses
- ADDRESSES can be shipping, billing or both
- A CUSTOMER can place zero, one or many ORDERS
- A CUSTOMER can have one or many PAYMENT_METHODS
- Each ORDER can involve one or many PRODUCTS
- Each ORDER can involve one or many SHIPMENTS

4. Additional characteristics

\*
