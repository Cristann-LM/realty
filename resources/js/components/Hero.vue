<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
  cities: {
    type: Array,
    default: () => [],
  },
  hero: {
    type: Object,
    default: () => ({
      hero_title: 'Find Your Dream Home',
      hero_description: 'Discover the finest properties in Cavite. Your next chapter begins here. We are committed to helping you find your dream home with personalized service and expert guidance.',
      hero_image: 'images/hero.jpg',
    }),
  },
})



// Options for our dropdowns
const propertyTypes = ref([
  { value: '', text: 'Property Type' },
  { value: 'Rowhouse', text: 'Row House' },
  { value: 'Townhouse', text: 'Townhouse' },
  { value: 'Single Attached', text: 'Single Attached' },
]);

const filterForm = useForm({
  price_min: "",
  price_max:"",
  location:  "",
  propertyType: "",
})

const filter = () => {
  filterForm.get(
    route('properties.index'),
    {
      preserveState: true,
      preserveScroll: true,
    },
  )
}
</script>about?.image.startsWith('http') ? about?.image : '/storage/' + about?.image

<template>
  <section
    :style="`background-image: url('${props.hero.hero_image.startsWith('http') ? props.hero.hero_image : '/storage/' + props.hero.hero_image}');`"
    class="relative bg-cover bg-center bg-fixed h-screen min-h-[600px] w-full"
  >
    <div class="absolute inset-0 bg-slate-900/60"></div>

    <div class="relative z-10 h-full flex flex-col items-center justify-center animate-fade-in-up px-4">
      <div class="text-center text-white">
        <h1 class="text-5xl mt-15 md:mt-0 sm:text-6xl lg:text-7xl font-bold tracking-tight">
          {{ props.hero.hero_title }}
        </h1>
        <p class="mt-6 max-w-2xl mx-auto text-lg text-slate-200">
          {{ props.hero.hero_description }}
        </p>
      </div>

      <div class="mt-6 w-full max-w-4xl">
        <form
          @submit.prevent="filter"
          class="hidden md:flex items-center bg-white/20 backdrop-blur-md rounded-full shadow-lg overflow-hidden"
        >
            <div class="flex items-center p-3">
                 <svg class="h-6 w-6 text-white mr-3 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>

              <select v-model="filterForm.location"  class="bg-transparent text-white focus:outline-none focus:ring-0 border-0 p-0 custom-select">
              <option value="" class="text-slate-800">All Location</option>
            <option v-for="city in props.cities" :key="city" :value="city" class="text-slate-800">{{ city }}</option>
            </select>
          </div>
           <div class="h-8 w-px bg-white/30"></div>
          <div class="flex items-center p-3 flex-grow min-w-0">
           <svg class="h-6 w-6 text-white mr-3 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414-.336.75-.75.75h-.75a.75.75 0 01-.75-.75v-.75m0-3l-3-3m0 0l-3 3m3-3v12" /></svg>
           <input type="number" v-model.number="filterForm.price_min" placeholder="Min Price"  class="bg-transparent text-white placeholder-slate-300 focus:outline-none focus:ring-0 border-0 p-0 text-sm w-full"/>
          </div>

          <div class="flex items-center p-3 flex-grow min-w-0">
           <svg class="h-6 w-6 text-white mr-3 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414-.336.75-.75.75h-.75a.75.75 0 01-.75-.75v-.75m0-3l-3-3m0 0l-3 3m3-3v12" /></svg>

            <input type="number" v-model.number="filterForm.price_max" placeholder="Max Price"  class="bg-transparent text-white placeholder-slate-300 focus:outline-none focus:ring-0 border-0 p-0 text-sm w-full"/>
          </div>
          <div class="h-8 w-px bg-white/30"></div>
          <div class="flex items-center p-3">
            <svg class="h-6 w-6 text-white mr-3 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h4.5V16.5M12.75 3h7.5v4.5M2.25 3h7.5v4.5" /></svg>
            <select v-model="filterForm.propertyType"  class="bg-transparent text-white focus:outline-none focus:ring-0 border-0 p-0 custom-select">
              <option v-for="option in propertyTypes" :key="option.value" :value="option.value" class="text-slate-800">{{ option.text }}</option>
            </select>
          </div>


          <button type="submit" class="flex-shrink-0 rounded-full bg-green-600 p-3 cursor-pointer text-white transition hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-white m-1.5" aria-label="Search">
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
          </button>
        </form>

        <form @submit.prevent="filter" class="md:hidden bg-white/20 backdrop-blur-md rounded-lg shadow-lg p-4 space-y-1.5">
          <div class="flex items-center px-3 py-2 bg-black/20 rounded-md">
            <svg class="h-5 w-5 text-white mr-3 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
            <select v-model="filterForm.location"  class="w-full bg-transparent text-white placeholder-slate-300 focus:outline-none focus:ring-0 border-0 p-0 text-sm">
              <option value="" class="text-slate-800">All Location</option>
            <option v-for="city in props.cities" :key="city" :value="city" class="text-slate-800">{{ city }}</option>
            </select>
          </div>
          <div class="flex items-center px-3 py-2 bg-black/20 rounded-md">
            <svg class="h-5 w-5 text-white mr-3 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h4.5V16.5M12.75 3h7.5v4.5M2.25 3h7.5v4.5" /></svg>
            <select v-model="filterForm.propertyType" class="w-full bg-transparent text-white focus:outline-none focus:ring-0 border-0 p-0 custom-select text-sm">
              <option v-for="option in propertyTypes" :key="option.value" :value="option.value" class="text-slate-800">{{ option.text }}</option>
            </select>
          </div>
          <div class="flex items-center px-3 py-2 bg-black/20 rounded-md">
            <svg class="h-5 w-5 text-white mr-3 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414-.336.75-.75.75h-.75a.75.75 0 01-.75-.75v-.75m0-3l-3-3m0 0l-3 3m3-3v12" /></svg>
            <input type="number" v-model.number="filterForm.price_min" placeholder="Min Price"  class="bg-transparent text-white placeholder-slate-300 focus:outline-none focus:ring-0 border-0 p-0 text-sm w-full"/>
          </div>
           <div class="flex items-center px-3 py-2 bg-black/20 rounded-md">
            <svg class="h-5 w-5 text-white mr-3 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414-.336.75-.75.75h-.75a.75.75 0 01-.75-.75v-.75m0-3l-3-3m0 0l-3 3m3-3v12" /></svg>
            <input type="number" v-model.number="filterForm.price_max" placeholder="Max Price"  class="bg-transparent text-white placeholder-slate-300 focus:outline-none focus:ring-0 border-0 p-0 text-sm w-full"/>
          </div>
          <button type="submit" class="w-full bg-green-600 text-white font-semibold transition hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-slate-900 focus:ring-green-500 p-3 flex items-center justify-center rounded-md">
            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
            <span class="text-sm">Search</span>
          </button>
        </form>
      </div>

      <div class="mt-8 text-center text-slate-300 text-sm">
        <p>
          Not sure where to start?
          <a :href="route('properties.index')" class="font-semibold text-white underline hover:text-green-300 transition-colors">
            Explore our featured projects
          </a>
          or
          <a :href="route('contact-us.index')" class="font-semibold text-white underline hover:text-green-300 transition-colors">
            speak to an agent.
          </a>
        </p>
      </div>
    </div>
  </section>
</template>

<style>
/* Base animation */
@keyframes fade-in-up {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in-up {
  animation: fade-in-up 0.8s ease-out forwards;
}

/* Custom styling for the select dropdown arrow */
.custom-select {
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
  background-position: right 0.5rem center;
  background-repeat: no-repeat;
  background-size: 1.5em 1.5em;
  padding-right: 2.5rem;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
}
</style>
