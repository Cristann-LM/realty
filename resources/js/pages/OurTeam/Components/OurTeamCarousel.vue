<template>
    <section class="bg-gray-50 py-16 md:py-24">
      <div class="container mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-semibold text-gray-800 text-center mb-12">Meet Our Team</h2>


        <Carousel v-bind="settings" :breakpoints="breakpoints" :wrap-around="false">
            <Slide v-for="(member, index) in teamMembers" :key="index">
              <OurTeamCard :team="member" />
            </Slide>
          <template #addons>
            <Navigation />
            <Pagination />
          </template>
        </Carousel>

      </div>
    </section>
</template>

<script setup  >
import { ref } from 'vue';
import 'vue3-carousel/dist/carousel.css';
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel';
import OurTeamCard from './OurTeamCard.vue';


// --- Carousel Settings ---
const settings = ref({
  itemsToShow: 1,
  snapAlign: 'center',
});

const breakpoints = ref({
  // 768px and up
  768: {
    itemsToShow: 2,
    snapAlign: 'start',
  },
  // 1024 and up
  1024: {
    itemsToShow: 3,
    snapAlign: 'start',
  },
});


defineProps({
  teamMembers: {
    type: Array,
    default: () => []
  }
});
</script>

<style>
/* Adjusting carousel navigation and pagination colors to align with green theme */
.carousel__prev,
.carousel__next {
  background-color: rgb(21 128 61 / var(--tw-bg-opacity)); /* bg-green-700 */
  border-radius: 50%;
  width: 3rem;
  height: 3rem;
  color: green; /* Changed arrow color to white for better contrast */
  transition: background-color 0.3s, opacity 0.3s;
}

.carousel__prev:hover,
.carousel__next:hover {
  background-color: rgb(22 101 52 / var(--tw-bg-opacity)); /* bg-green-800 */
}

.carousel__prev--disabled,
.carousel__next--disabled {
  opacity: 0.4;
  cursor: not-allowed;
}

.carousel__pagination-button::after {
  background-color: rgb(134 239 172 / var(--tw-bg-opacity)); /* bg-green-300 */
}

.carousel__pagination-button--active::after {
  background-color: rgb(21 128 61 / var(--tw-bg-opacity)); /* bg-green-700 */
}
</style>
