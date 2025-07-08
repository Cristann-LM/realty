<script setup lang="ts">
import Banner from '@/components/Banner.vue';
import Footer from '@/components/Footer.vue';
import MainLayout from '@/components/MainLayout.vue';
import { Link } from '@inertiajs/vue3';
import { computed, ref } from 'vue';


interface Property {
    id: string;
    name: string;
    price: number;
    bedrooms?: number; // Added optional bedrooms property
    bathrooms?: number; // Added optional bathrooms property
    parking_spaces?: number; // Added optional carGarage property
    property_images: Array<{
        id: string;
        image_path: string;
    }>;
    project: {
        name: string;
        address: string;
        city: string;
        province: string;
        description?: string; // Optional description for the project
        google_map_link?: string; // Optional Google Map embed code
        amenities: Array<{
            id: string;
            name: string;
        }>;
    };
}

const props = defineProps<{
    property: Property;
}>();

// ...existing imports and code...

const currentImage = ref(0);

const images = computed(() => props.property.property_images || []);

function prevImage() {
    if (images.value.length === 0) return;
    currentImage.value = (currentImage.value - 1 + images.value.length) % images.value.length;
}

function nextImage() {
    if (images.value.length === 0) return;
    currentImage.value = (currentImage.value + 1) % images.value.length;
}
const formattedPrice = computed(() => {
    return new Intl.NumberFormat('en-PH', {
        style: 'currency',
        currency: 'PHP',
        minimumFractionDigits: 0,
    }).format(props.property.price);
});
</script>

<template>
    <div class="bg-gray-50 ">
        <MainLayout />
        <Banner bannerImg="../images/BNNR6.jpg">
            <h1 class="text-4xl md:text-6xl mt-20 font-bold leading-tight mb-4">Properties</h1>
            <p class="text-lg md:text-xl max-w-3xl">Discover the finest properties in Phillipines. Your next chapter begins here.</p>
        </Banner>
        <div class="bg-gray-50 py-10">
            <div class="container mx-auto px-4 max-w-screen-xl">

                <Link :href="route('properties.index')" class="inline-flex items-center text-green-700 hover:text-green-900 transition-colors duration-200 mb-6">
                    <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Properties
                </Link>
<div class="bg-white rounded-xl shadow-lg overflow-hidden md:flex">
                <div class="md:w-3/5 w-full bg-gray-100 relative">
    <div v-if="images.length" class="relative w-full h-96 md:h-[500px] flex items-center justify-center">
        <img
            :src="images[currentImage].image_path.startsWith('http') ? images[currentImage].image_path : '/storage/' + images[currentImage].image_path"
            :alt="`Property Image ${currentImage + 1}`"
            class="object-cover w-full h-full rounded-lg transition-all duration-500"
        />
        <!-- Prev Button -->
        <button
            @click="prevImage"
            class="absolute left-4 top-1/2 -translate-y-1/2 bg-white bg-opacity-70 hover:bg-opacity-100 rounded-full p-2 shadow"
        >
            <svg class="h-6 w-6 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <!-- Next Button -->
        <button
            @click="nextImage"
            class="absolute right-4 top-1/2 -translate-y-1/2 bg-white bg-opacity-70 hover:bg-opacity-100 rounded-full p-2 shadow"
        >
            <svg class="h-6 w-6 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>
        <!-- Dots -->
        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex space-x-2">
            <span
                v-for="(img, idx) in images"
                :key="idx"
                class="w-3 h-3 rounded-full"
                :class="idx === currentImage ? 'bg-green-700' : 'bg-gray-300'"
            ></span>
        </div>
    </div>
    <div v-else class="w-full h-96 md:h-[500px] flex items-center justify-center text-gray-400 text-xl border-dashed border-2 border-gray-300 rounded-lg m-4">
        No images available
    </div>
</div>

                    <div class="md:w-2/5 w-full p-6 lg:p-10 flex flex-col justify-between">
                        <div>
                            <h1 class="text-3xl lg:text-4xl font-bold text-slate-800 mb-3">{{ property.project.name }}-<span class="font-normal text-slate-800">{{ property.name }}</span></h1>
                            <div class="flex items-center text-gray-600 mb-4">
                                <svg class="mr-2 h-5 w-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M9.69 18.933l.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001.006-.003.018-.008a5.741 5.741 0 00.281-.14c.186-.1.4-.27.615-.454a6.464 6.464 0 00.655-.572l.001-.001.002-.002.002-.002a6.5 6.5 0 00.622-.599l.004-.004.004-.004a6.462 6.462 0 00.51-.494l.003-.004.002-.003a6.5 6.5 0 00.415-.45l.003-.004.003-.004A6.473 6.473 0 0015 13c0-1.657-1.343-3-3-3s-3 1.343-3 3c0 .353.062.69.176 1.006a6.47 6.47 0 00.342.828l.002.003.002.003.003.004.003.004a6.52 6.52 0 00.243.38l.003.004.003.004.004.004a6.567 6.567 0 00.217.302l.003.004.003.003a6.6 6.6 0 00.18.232l.003.003a6.472 6.472 0 00.14.162l.003.003.002.002a6.442 6.442 0 00.09.09l.002.002.002.002.001.001a6.47 6.47 0 00.064.058l.002.001.001.001zM10 11a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                </svg>
                                <span>{{property.project.address}},{{ property.project.city }} {{ property.project.province }}</span>
                            </div>
                            <p class="text-3xl lg:text-4xl font-extrabold text-green-700 mb-6">{{formattedPrice }}</p>

                            <div class="flex items-center space-x-6 mb-6">
                                <div v-if="property.bedrooms" class="flex items-center text-gray-700">

                                   <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-green-600" viewBox="0 0 512 512"><path d="M64 131.9C64 112.1 80.1 96 99.9 96c9.5 0 18.6 3.8 25.4 10.5l16.2 16.2c-21 38.9-17.4 87.5 10.9 123L151 247c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0L345 121c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-1.3 1.3c-35.5-28.3-84.2-31.9-123-10.9L170.5 61.3C151.8 42.5 126.4 32 99.9 32C44.7 32 0 76.7 0 131.9L0 448c0 17.7 14.3 32 32 32s32-14.3 32-32l0-316.1zM256 352a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm64 64a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm0-128a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm64 64a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm0-128a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm64 64a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm32-32a32 32 0 1 0 0-64 32 32 0 1 0 0 64z"/></svg>
                                   <span>{{ property.bedrooms }} Bed<span v-if="property.bedrooms > 1">s</span></span>
                                </div>
                                <div v-if="property.bathrooms" class="flex items-center text-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-green-600" viewBox="0 0 640 512"><path d="M32 32c17.7 0 32 14.3 32 32l0 256 224 0 0-160c0-17.7 14.3-32 32-32l224 0c53 0 96 43 96 96l0 224c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-32-224 0-32 0L64 416l0 32c0 17.7-14.3 32-32 32s-32-14.3-32-32L0 64C0 46.3 14.3 32 32 32zm144 96a80 80 0 1 1 0 160 80 80 0 1 1 0-160z"/></svg>

                                    <span>{{ property.bathrooms }} Bath<span v-if="property.bathrooms > 1">s</span></span>
                                </div>
                                <div v-if="property.parking_spaces" class="flex items-center text-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-green-600"  viewBox="0 0 512 512"><path d="M135.2 117.4L109.1 192l293.8 0-26.1-74.6C372.3 104.6 360.2 96 346.6 96L165.4 96c-13.6 0-25.7 8.6-30.2 21.4zM39.6 196.8L74.8 96.3C88.3 57.8 124.6 32 165.4 32l181.2 0c40.8 0 77.1 25.8 90.6 64.3l35.2 100.5c23.2 9.6 39.6 32.5 39.6 59.2l0 144 0 48c0 17.7-14.3 32-32 32l-32 0c-17.7 0-32-14.3-32-32l0-48L96 400l0 48c0 17.7-14.3 32-32 32l-32 0c-17.7 0-32-14.3-32-32l0-48L0 256c0-26.7 16.4-49.6 39.6-59.2zM128 288a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm288 32a32 32 0 1 0 0-64 32 32 0 1 0 0 64z"/></svg>
                                    <span>{{ property.parking_spaces }} Car Garage</span>
                                </div>
                            </div>

                            <p class="text-gray-700 leading-relaxed mb-6">
                                {{ property.project.description || 'No description available for this property.' }}
                                </p>
                        </div>
                        <div class="mt-auto">
                            <button class="w-full bg-green-700 text-white py-3 rounded-md font-semibold text-lg hover:bg-green-800 transition-colors duration-200 shadow-md">
                                Inquire About This Property
                            </button>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6 lg:p-10 mt-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Amenities & Features</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-y-3 gap-x-6 text-gray-700">
                        <div v-for="amenity in property.project.amenities" :key="amenity.id"  class="flex items-center">
                            <svg class="h-5 w-5 text-green-600 mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>{{ amenity.name }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6 lg:p-10 mt-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Location Map</h2>
                    <div v-html="property.project?.google_map_link"  class="w-full h-80 rounded-lg overflow-hidden shadow-inner flex items-center justify-center text-gray-400 text-lg border-dashed border-2 border-gray-300">
                    </div>
                </div>

            </div>
        </div>
        <Footer></Footer>
    </div>
</template>
