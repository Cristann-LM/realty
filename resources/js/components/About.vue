<template>
  <div>
    <section class="py-16 md:py-24 bg-white relative overflow-hidden">
      <div class="container mx-auto px-4 max-w-screen-xl relative z-10">
        <div class="text-center mb-12">
          <h2 class="
              text-3xl md:text-4xl font-semibold text-gray-800 mb-4
              relative inline-block pb-2
            ">
            About Our Company
            <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-24 h-1 bg-green-500 rounded-full"></span>
          </h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
          <div class="flex flex-col h-full justify-center p-6 bg-white bg-opacity-70 rounded-lg shadow-inner backdrop-blur-sm">
            <p v-if="about?.description" class="text-lg text-gray-700 leading-relaxed">
                {{ about.description }}
            </p>
            <p v-else class="text-lg text-gray-400">
                Company description is not available at the moment.
            </p>
          </div>

          <div class="flex flex-col space-y-8">
            <div class="p-8 rounded-lg border border-green-100 shadow-md bg-white bg-opacity-70 h-full transform transition-transform duration-300 hover:-translate-y-1 backdrop-blur-sm">
              <h3 class="text-2xl font-bold text-green-800 mb-4 flex items-center">
                <svg class="h-9 w-9 mr-4 text-green-700 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                   <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944c-1.233 0-2.455.267-3.575.792a11.947 11.947 0 00-4.484 2.871c-1.393 1.393-2.421 2.99-3.038 4.752A11.966 11.966 0 012 12.023c0 3.09 1.15 5.966 3.038 8.134a11.947 11.947 0 004.484 2.871A11.955 11.955 0 0112 21.056c1.233 0 2.455-.267 3.575-.792a11.947 11.947 0 004.484-2.871C21.45 15.989 22.5 13.09 22.5 12.023c0-.044-.003-.088-.008-.132L21.82 9.243a.75.75 0 00-.974-.298z" />
                </svg>
                Our Mission
              </h3>
              <p class="text-gray-700 leading-relaxed">
                {{ about?.mission }}
              </p>
            </div>

            <div class="p-8 rounded-lg border border-green-100 shadow-md bg-white bg-opacity-70 h-full transform transition-transform duration-300 hover:-translate-y-1 backdrop-blur-sm">
              <h3 class="text-2xl font-bold text-green-800 mb-4 flex items-center">
                 <svg class="h-9 w-9 mr-4 text-green-700 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                   <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639l4.368-7.563A1.012 1.012 0 017.5 4.002h9a1.012 1.012 0 01.896.56l4.368 7.563a1.012 1.012 0 010 .639l-4.368 7.563A1.012 1.012 0 0116.5 20.002h-9a1.012 1.012 0 01-.896-.56l-4.368-7.563z" />
                   <path stroke-linecap="round" stroke-linejoin="round" d="M12 15.75h.008v.008H12v-.008z" />
                 </svg>
                Our Vision
              </h3>
              <p class="text-gray-700 leading-relaxed">
                {{ about?.vision }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup lang="ts">
// IMPROVED: Using a TypeScript interface for type safety
interface AboutData {
  description?: string;
  mission?: string;
  vision?: string;
}

defineProps<{
  about?: AboutData;
}>();
</script>
