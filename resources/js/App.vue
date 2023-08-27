<template>
  <component id="app" :is="layout">
    <vue-page-transition name="fade">
      <router-view />
    </vue-page-transition>
  </component>
</template>

<script>
import LayoutFull from '@/@core/components/layouts/Full.vue'
import LayoutMain from '@/@core/components/layouts/Main.vue'

export default {
  components: {
    LayoutFull,
    LayoutMain,
  },
  computed: {
    layout() {
      if (!this.$store.getters['auth/isAuthenticated']) return 'layout-full'
      if (this.$route.meta?.layout == 'full') return 'layout-full'
      return 'layout-main'
    },
  },
}
</script>