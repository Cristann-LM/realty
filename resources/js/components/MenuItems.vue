<template>

    <Link
        :href="route(props.labels.href)"
        class="relative flex h-full items-center px-8 py-4 cursor-pointer font-bold text-green-950 hover:text-green-800 hover:bg-gray-300/20 transition-colors ease-in"
    >
        {{ props.labels.title }}
    </Link>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    labels: Object,
})

</script>
