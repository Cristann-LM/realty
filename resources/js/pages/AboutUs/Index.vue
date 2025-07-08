<script setup lang="ts">
import MainLayout from '@/components/MainLayout.vue';

import About from '@/components/About.vue';
import Banner from '@/components/Banner.vue';
import Footer from '@/components/Footer.vue';
import OurJourney from './Components/OurJourney.vue';

defineProps ({
    about: Object,
    journey: Array,
});


</script>

<template>
    <MainLayout />
     <Banner>
        <h1 class="text-4xl md:text-6xl mt-20 font-bold leading-tight mb-4">About Us</h1>
        <p class="text-lg md:text-xl max-w-3xl">Discover a seamless and rewarding property journey with a team that cares.</p>
    </Banner>
     <About :about="about"/>
     <OurJourney :journeys="journey" :about="about"/>
    <Footer></Footer>
</template>

