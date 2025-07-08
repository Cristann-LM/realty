<script setup lang="ts">
import MainLayout from '@/components/MainLayout.vue';
import Contact from '@/components/Contact.vue';
import Footer from '@/components/footer.vue';
import Banner from '@/components/Banner.vue';

defineProps({
    contact: Object,
});

import { useFlashToaster } from '@/composables/useFlashToaster';
useFlashToaster();

</script>

<template>
    <MainLayout />
    <Banner>
        <h1 class="text-4xl md:text-6xl mt-20 font-bold leading-tight mb-4">Get in Touch</h1>
        <p class="text-lg md:text-xl max-w-3xl">We'd love to hear from you. Whether you have a question about our services or anything else, our team is ready to answer all your questions.</p>
    </Banner>
     <Contact  :contact="contact" />
    <Footer></Footer>
</template>
