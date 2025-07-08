<script setup lang="ts">
import MainLayout from '@/components/MainLayout.vue';
import Banner from '@/components/Banner.vue';
import Footer from '@/components/Footer.vue';
import OurTeamCard from './Components/OurTeamCard.vue';

// --- Team Members Data ---
defineProps({
    teams: {
        type: Array,
        required: true
    }

})


</script>

<template >
    <div class="bg-gray-50 min-h-screen">
    <MainLayout />
     <Banner bannerImg="./images/BNNR6.jpg">
  <h1 class="text-4xl md:text-6xl mt-20 font-bold leading-tight mb-4">Meet Our Team</h1>
        <p class="text-lg md:text-xl max-w-3xl">Our dedicated team of real estate professionals is here to guide you every step of the way.</p>
        </Banner>
     <div class="container mx-auto px-4 max-w-screen-xl py-16">
        <!-- <h2 class="text-3xl md:text-4xl font-semibold text-gray-800 mb-8 text-center">Meet Our Team</h2>
        <p class="text-lg text-gray-600 mb-12 text-center"></p> -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
     <OurTeamCard v-for="team in teams" :key="team.id" :team="team" class="bg-white" />
     </div>
     </div>
    <Footer></Footer>
    </div>
</template>

