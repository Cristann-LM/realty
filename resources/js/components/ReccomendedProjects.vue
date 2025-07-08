<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue';
import ModelCard from '@/components/ModelCard.vue';


defineProps({
    properties : {
        type: Array,
        default: () => []
    }
});

// --- Template Ref for the carousel element ---
const carousel = ref<HTMLDivElement | null>(null);

// --- A. Reactive State for Button/Edge Visibility ---
const isAtStart = ref(true);
const isAtEnd = ref(false);

// --- B. Scroll handler to update the reactive state ---
const handleScroll = () => {
    if (!carousel.value) return;
    const el = carousel.value;
    // Check if at the start
    isAtStart.value = el.scrollLeft === 0;
    // Check if at the end (with a 1px buffer for floating point precision)
    isAtEnd.value = el.scrollLeft + el.clientWidth >= el.scrollWidth - 1;
};

// --- Function to scroll the carousel smoothly ---
const scrollCarousel = (direction: 'prev' | 'next') => {
    if (!carousel.value) return;
    const el = carousel.value;
    const itemWidth = (el.firstElementChild as HTMLElement)?.clientWidth ?? 300;
    const gap = 16; // Corresponds to `gap-4` in Tailwind (1rem = 16px)
    const scrollAmount = itemWidth + gap;

    el.scrollBy({
        left: direction === 'prev' ? -scrollAmount : scrollAmount,
        behavior: 'smooth',
    });
};

// --- C. Lifecycle Hooks to add and remove the scroll listener ---
onMounted(() => {
    if (carousel.value) {
        handleScroll(); // Check initial state on load
        carousel.value.addEventListener('scroll', handleScroll, { passive: true });
    }
});

onUnmounted(() => {
    if (carousel.value) {
        carousel.value.removeEventListener('scroll', handleScroll);
    }
});
</script>

<template>
    <section class="py-20 sm:py-24 bg-gray-50">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="max-w-2xl mx-auto text-center">
                <h2 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">Recommended Projects</h2>
                <p class="mt-4 text-lg leading-8 text-gray-600">
                    Discover our premier properties, thoughtfully designed for modern living in prime locations around Cavite.
                </p>
            </div>

            <div class="relative mt-16">

                <div
                    ref="carousel"
                    class="flex w-full gap-6 overflow-x-auto pb-6 snap-x scroll-smooth scrollbar-hide"
                >
                    <ModelCard v-for="(property, index) in properties" :key="index" :card="property" />
                </div>

                <button
                    v-show="!isAtStart"
                    @click="scrollCarousel('prev')"
                    class="absolute top-1/3 -translate-y-1/2 -left-6 w-12 h-12 rounded-full bg-white/90 backdrop-blur-sm shadow-lg flex items-center justify-center hover:bg-white transition-all duration-300 z-10"
                    aria-label="Previous Project"
                >
                    <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 8 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 1 1.3 6.326a.91.91 0 0 0 0 1.348L7 13" />
                    </svg>
                </button>

                <button
                    v-show="!isAtEnd"
                    @click="scrollCarousel('next')"
                    class="absolute top-1/3 -translate-y-1/2 -right-6 w-12 h-12 rounded-full bg-white/90 backdrop-blur-sm shadow-lg flex items-center justify-center hover:bg-white transition-all duration-300 z-10"
                    aria-label="Next Project"
                >
                    <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 8 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 13 5.7-5.326a.909.909 0 0 0 0-1.348L1 1" />
                    </svg>
                </button>

                <div v-show="!isAtStart" class="absolute top-0 left-0 h-full w-24 bg-gradient-to-r from-gray-50 to-transparent pointer-events-none"></div>
                <div v-show="!isAtEnd" class="absolute top-0 right-0 h-full w-24 bg-gradient-to-l from-gray-50 to-transparent pointer-events-none"></div>
            </div>
        </div>
    </section>

</template>

<style>
/* Utility to hide the scrollbar */
.scrollbar-hide::-webkit-scrollbar { display: none; }
.scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
</style>
