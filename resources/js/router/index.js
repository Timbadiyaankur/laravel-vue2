import Vue from 'vue'
import VueRouter from 'vue-router'

import store from '@/store'

import authRoutes from '@/router/auth.routes'
import productRoutes from '@/router/product.routes'

Vue.use(VueRouter)

const router = new VueRouter({
  mode: 'history',
  base: '/',
  // base: process.env.BASE_URL,
  scrollBehavior() {
    return { x: 0, y: 0, behavior: 'smooth' }
  },
  routes: [
    { path: '/', redirect: { name: 'sign-in' } },
    ...authRoutes,
    ...productRoutes,
    {
      path: '*',
      redirect: 'error-404',
    },
  ],
})

const sendBackToLogin = next => next({ name: 'sign-in' })
const sendBackToDashboard = next => next({ name: 'home' })

const checkAuth = async (to, from, next) => {
  const loggedIn = await store.dispatch('auth/verifyAuth')
  // Ensure we checked auth before each page load.
  if (!to.meta.allowAll) {
    if ('guarded' in to.meta) {
      if (to.meta.guarded) {
        if (!loggedIn) {
          return sendBackToLogin(next)
        }
      } else if (loggedIn) {
        return sendBackToDashboard(next)
      }
    } else if (!loggedIn) {
      return sendBackToLogin(next)
    }
  }
  return next()
}

// eslint-disable-next-line consistent-return
const checkPageAccess = async (to, from, next) => {
  const user = store.getters['auth/currentUser']
  // check is page requires permissions and check is user has permission to visit the page

  if (
    !(!to.meta?.permissions || (to.meta?.permissions && (to.meta?.permissions || []).some(i => hasBitMaskValue(i, user.permissionBitmask))))
  ) {
    router.app.$toast({
      component: ToastificationContent,
      props: {
        title: 'Error',
        icon: 'LockIcon',
        variant: 'danger',
        text: `You don't have access to \`${to.name}\` page`,
      },
    })
    return sendBackToDashboard(next)
    // eslint-disable-next-line no-else-return
  } else if (!(!to.meta?.needToBeMaster || (to.meta?.needToBeMaster && user.isMaster))) {
    router.app.$toast({
      component: ToastificationContent,
      props: {
        title: 'Error',
        icon: 'LockIcon',
        variant: 'danger',
        text: `You don't have access to \`${to.name}\` page`,
      },
    })
    return sendBackToDashboard(next)
  }
  next()
}

router.beforeEach(checkAuth)

router.afterEach(() => {
  // Remove initial loading
  const body = document.body
  body.classList.remove('hold-transition')
})

export default router
