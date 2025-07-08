<script setup lang="ts">
import Banner from '@/components/Banner.vue';
import Footer from '@/components/Footer.vue';
import MainLayout from '@/components/MainLayout.vue';
import ModelCard from '@/components/ModelCard.vue';

import PropertyFilter from './Components/PropertyFilter.vue';
import Pagination from '@/components/Pagination.vue';

defineProps({
    filters : {
        type: Object,
        default: () => ({
            price_min: null,
            price_max: null,
            location: null,
            propertyType: null,
        }),
    },
    properties: {
        type: Object,
    },
    cities: {
        type: Array,
        default: () => [],
    },
})

</script>

<template>
    <div class="bg-gray-50 ">
    <MainLayout />
    <Banner>
        <h1 class="text-4xl md:text-6xl mt-20 font-bold leading-tight mb-4">Properties</h1>
        <p class="text-lg md:text-xl max-w-3xl">Discover the finest properties in Phi. Your next chapter begins here.</p>
    </Banner>

    <div class="container mx-auto px-4 py-8 w-5/6">
        <!-- <h2 class="text-2xl font-bold mb-6 text-gray-600">Featured Properties</h2> -->
        <PropertyFilter :filters="filters" :cities="cities" />
        <!-- <div v-if="properties.data.length" class="w-full flex justify-end mt-8 mb-8 text-green-800">
            <Pagination :links="properties.links" />
        </div> -->
        <div v-if="!properties.data.length" class="text-center text-xl text-gray-500 font-semibold my-12">
            No available property
        </div>
        <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            <ModelCard v-for="(card, index) in properties.data" :key="index" :card="card" />
        </div>
        <div v-if="properties.data.length" class="w-full flex justify-center mt-8 mb-8 text-green-800">
            <Pagination :links="properties.links" />
        </div>
    </div>
    <Footer></Footer>
    </div>
</template>
