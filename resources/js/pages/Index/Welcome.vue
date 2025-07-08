<script setup lang="ts">
import MainLayout from '@/components/MainLayout.vue';
import Hero from '@/components/Hero.vue';
import ReccomendedProjects from '@/components/ReccomendedProjects.vue';
import Banner from '@/components/Banner.vue';
import Footer from '@/components/Footer.vue';
import OurJourney from '../AboutUs/Components/OurJourney.vue';
import OurTeamCarousel from '../OurTeam/Components/OurTeamCarousel.vue';

defineProps({
    properties : {
        type: Array,
        default: () => []
    },
    journey: {
        type: Array,
        default: () => []
    },
    about: {
        type: Object,
        default: () => ({})
    },
    teamMembers: {
        type: Array,
        default: () => []
    },
     cities: {
    type: Array,
    default: () => [],
  },
  hero: {
    type: Object,
    default: () => ({
      hero_title: 'Find Your Dream Home',
      hero_description: 'Discover the finest properties in Cavite. Your next chapter begins here. We are committed to helping you find your dream home with personalized service and expert guidance.',
      hero_image: 'images/hero.jpg'
    })
  }
});

</script>

<template>
    <MainLayout />
    <Hero :hero="hero" :cities="cities"/>
     <ReccomendedProjects :properties="properties" />
     <Banner bannerImg="./images/BNNR6.jpg"/>
     <OurJourney :journeys="journey" :about="about"/>
     <OurTeamCarousel :teamMembers="teamMembers"/>
    <Footer></Footer>
</template>
