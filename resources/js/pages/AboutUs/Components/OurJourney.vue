<template  >
    <section class="py-16 md:py-24 bg-gray-50">
      <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-16 items-start">
            <div class="w-full">
              <img
              :src="about?.image.startsWith('http') ? about?.image : '/storage/' + about?.image"
              alt="Beautiful modern home interior" class="rounded-lg shadow-xl object-cover w-full h-full">
            </div>
            <div>
              <h2 class="text-3xl md:text-4xl font-semibold text-gray-800 mb-8 text-left">Our Journey</h2>
              <div class="relative">
                <div class="absolute left-3 top-0 h-full w-0.5 bg-green-200"></div>
                 <div  class="relative mb-8 pl-12">
                  <div class="absolute left-0 top-1.5 w-6 h-6 bg-green-500 rounded-full border-4 border-white"></div>
                  <h3 class="font-bold text-lg text-gray-800">Today - Your Trusted Partner</h3>
                  <p class="text-gray-600 leading-relaxed">
                     We are proud to be a part of our clients' most significant life moments and continue to innovate in the real estate space.

                  </p>
                </div>
                <div  v-for="journey in journeys"
                                :key="journey.title" class="relative mb-8 pl-12">
                  <div class="absolute left-0 top-1.5 w-6 h-6 bg-green-500 rounded-full border-4 border-white"></div>
                  <h3 class="font-bold text-lg text-gray-800">{{ journey.year }} - {{journey.title}}</h3>
                  <p class="text-gray-600 leading-relaxed">
                    {{ journey.description }}
                  </p>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

        <section class="py-16 md:py-24 bg-white">
      <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-semibold text-gray-800 mb-4">Ready to Start Your Journey With Us?</h2>
        <p class="text-gray-600 max-w-2xl mx-auto mb-8">Whether you're looking to buy, sell, or simply have a question, our team is here to help. Let's connect and make your real estate dreams a reality.</p>
        <a href="/contact" class="bg-green-700 text-white font-bold py-3 px-8 rounded-lg hover:bg-green-800 transition duration-300">Contact Us</a>
      </div>
    </section>
</template>

<script setup lang="ts">
// IMPROVED: Using a TypeScript interface for type safety


defineProps ({
    journeys: Array,
    about: Object,
});

</script>
