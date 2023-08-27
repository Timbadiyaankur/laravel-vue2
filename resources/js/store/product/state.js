const emptyProduct = { sku: null, name: null, description: null, style: null, color: null, size: null, price: null }

export default {
  loading: false,
  emptyProduct: { ...emptyProduct },
  product: { ...emptyProduct },
}
