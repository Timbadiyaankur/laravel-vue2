export default [
  {
    name: 'product-list',
    path: '/product/list',
    component: () => import('@/pages/product/ProductList.vue'),
    meta: {
      title: 'Manage Products',
      layout: 'main',
      breadcrumbs: [
        { title: 'Home', to: { name: 'home' } },
        { title: 'Product', to: { name: 'product-list' }, active: true },
      ],
    },
  },
  {
    name: 'create-product',
    path: '/product/create',
    component: () => import('@/pages/product/CreateProduct.vue'),
    meta: {
      title: 'Create Products',
      layout: 'main',
      breadcrumbs: [
        { title: 'Home', to: { name: 'home' } },
        { title: 'Product', to: { name: 'product-list' } },
        { title: 'Create Product', to: { name: 'create-product' }, active: true },
      ],
    },
  },
  {
    name: 'edit-product',
    path: '/product/:id',
    component: () => import('@/pages/product/EditProduct.vue'),
    meta: {
      title: 'Edit Products',
      layout: 'main',
      breadcrumbs: [
        { title: 'Home', to: { name: 'home' } },
        { title: 'Product', to: { name: 'product-list' } },
        { title: 'Edit Product', to: { name: 'edit-product' }, active: true },
      ],
    },
  },
]
