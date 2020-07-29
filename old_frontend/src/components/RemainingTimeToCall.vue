<template>
  <section
    class="ag-item text"
    :style="style"
  >
    <slot />
  </section>
</template>
<script>
import gridArea from '@/mixins/gridArea'

export default {
  mixins: [gridArea],
}
</script>
