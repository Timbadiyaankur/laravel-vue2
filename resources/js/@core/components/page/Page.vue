<template>
  <div class="content-wrapper">
    <page-header />
    <section class="content">
      <slot />
    </section>
  </div>
</template>

<script>
import PageHeader from '@/@core/components/page/PageHeader.vue'
export default {
  components: { PageHeader },
}
</script>