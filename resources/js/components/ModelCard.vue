<script setup lang="ts">
import { computed } from 'vue';

// The interface now includes the 'price' property.
interface Card {
    id: string; // Add this line
    name: string;
    price: number;
    project: {
        name: string;
        address: string;
        city: string;
        province: string;
    };
    property_images?: {
        is_primary: boolean;
        image_path: string;
    }[];

}

const props = defineProps<{
    card: Card;
}>();

// This computed property formats the price number into a currency string.
const formattedPrice = computed(() => {
  return new Intl.NumberFormat('en-PH', {
    style: 'currency',
    currency: 'PHP',
    minimumFractionDigits: 0,
  }).format(props.card.price);
});

const primaryImage = computed(() => {
  const images = props.card.property_images ?? [];
  // Return the primary image if exists, otherwise the first image, otherwise null
  return images.find(img => img.is_primary) || images[0] || null;
});


</script>

<template>
  <div class="group min-w-[80%] md:min-w-[30%] h-[auto] transform transition-transform duration-300 ease-in-out opacity-90 group-hover:scale-105 hover:opacity-100">
    <a
      :href="`/properties/${props.card.id}`"
      class="block overflow-hidden rounded-2xl bg-white shadow-lg h-full"
    >
      <div class="relative overflow-hidden">
       <div
  :style="{
    backgroundImage: primaryImage
      ? `url('/storage/${primaryImage.image_path}')`
      : `url('./images/LANCASTER.jpg')`
  }"
  class="h-80 w-full bg-cover bg-center transition-transform duration-300 ease-in-out group-hover:scale-110"
></div>
        <div
          class="absolute top-4 right-4 rounded-full bg-red-600/90 px-4 py-1.5 text-sm font-semibold text-white backdrop-blur-sm"
        >
          {{ formattedPrice }}
        </div>
      </div>
      <div class="py-2 px-5">
        <h5 class="text-xl font-bold text-slate-800">{{ props.card.project.name }}-<span class="font-normal text-slate-800">{{ props.card.name }}</span></h5>
        <div class="mt-2 flex items-center text-sm text-slate-500">
          <svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M9.69 18.933l.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001.006-.003.018-.008a5.741 5.741 0 00.281-.14c.186-.1.4-.27.615-.454a6.464 6.464 0 00.655-.572l.001-.001.002-.002.002-.002a6.5 6.5 0 00.622-.599l.004-.004.004-.004a6.462 6.462 0 00.51-.494l.003-.004.002-.003a6.5 6.5 0 00.415-.45l.003-.004.003-.004A6.473 6.473 0 0015 13c0-1.657-1.343-3-3-3s-3 1.343-3 3c0 .353.062.69.176 1.006a6.47 6.47 0 00.342.828l.002.003.002.003.003.004.003.004a6.52 6.52 0 00.243.38l.003.004.003.004.004.004a6.567 6.567 0 00.217.302l.003.004.003.003a6.6 6.6 0 00.18.232l.003.003a6.472 6.472 0 00.14.162l.003.003.002.002a6.442 6.442 0 00.09.09l.002.002.002.002.001.001a6.47 6.47 0 00.064.058l.002.001.001.001zM10 11a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
          </svg>
          <span>{{props.card.project.address}},{{ props.card.project.city }} {{ props.card.project.province }}</span>
        </div>
        <div class="mt-6">
          <div class="inline-flex items-center rounded-full mb-3 text-sm font-semibold text-slate-800 transition-colors hover:opacity-70">
            View Details
            <span class="ml-1.5" aria-hidden="true">&rarr;</span>
          </div>
        </div>
      </div>
    </a>
  </div>

</template>
