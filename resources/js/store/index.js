import Vue from 'vue'
import Vuex from 'vuex'

import auth from './auth'
import product from './product'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    auth,
    product,
  },
  strict: import.meta.env.PROD,
})
