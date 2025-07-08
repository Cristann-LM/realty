<template>
  <div class="flex gap-1">
    <Link
      v-for="(link, index) in links"
      :key="index"
      class="py-2 px-4 rounded-md hover:opacity-80"
      :href="link.url ?? ''"
      :class="[
        { 'bg-green-800 dark:bg-green-800 text-gray-300 ': link.active },
        { 'pointer-events-none opacity-50': !link.url }
      ]"
      v-html="link.label"
      :disabled="!link.url"
    />
  </div>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
defineProps({ links: Array })
</script>
