export default {
  async create(_, payload) {
    return (await this._vm.$api.post('/product', payload)).data
  },
  async findById({ commit }, id) {
    commit('setState', [{ key: 'loading', value: true }])
    try {
      const res = (await this._vm.$api.get(`/product/${id}`)).data
      commit('setState', [
        { key: 'loading', value: false },
        { key: 'product', value: res.data },
      ])
    } catch (err) {
      commit('setState', [
        { key: 'loading', value: false },
        { key: 'product', value: {} },
      ])
      throw err
    }
  },
  async update(_, { id, data }) {
    return (await this._vm.$api.post(`/product/${id}`, data)).data
  },
  async dataTable(_, params) {
    return (await this._vm.$api.post('/product/list', params, { cancelToken: 'DATATABLE' })).data.data
  },
  async delete(_, id) {
    return (await this._vm.$api.delete(`/product/${id}`)).data
  },
}
