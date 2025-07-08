<template>
  <div class="bg-white p-4 sm:p-6 rounded-lg shadow-md mb-8 text-slate-800 max-w-screen-xl mx-auto">
    <h2 class="
      text-xl sm:text-2xl font-bold text-gray-800 mb-6
      text-center sm:text-center /* Center on mobile, left-align on larger screens */
    ">
      Find Your Property
    </h2>

    <form @submit.prevent="filter" class="flex flex-col sm:flex-row sm:items-end gap-4">

      <!-- <div class="flex-1 min-w-[150px]">
        <label for="propertyName" class="sr-only">Property Name</label>
        <div class="relative">
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
            </svg>
          </div>
          <input
            type="text"
            id="propertyName"
            v-model="filters.propertyName"
            placeholder="Search property"
            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
          />
        </div>
      </div> -->

    <div class="flex-1 min-w-[150px]">
    <label for="location" class="sr-only">Location</label>
    <div class="relative">
      <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
        <!-- svg icon -->
      </div>
      <select
        id="location"
        v-model="filterForm.location"
        class="block w-full pl-10 pr-10 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
      >
        <option value="">Select All City</option>
        <option v-for="city in props.cities" :key="city" :value="city">{{ city }}</option>
      </select>
    </div>
  </div>

      <div class="flex-1 min-w-[150px]">
        <label for="priceRange" class="sr-only">Price Range</label>
        <div class="relative">
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008.08 8.647L9.432 10l-1.352 1.353a1 1 0 001.475 1.475L10.907 10l1.353 1.353a1 1 0 001.475-1.475L12.353 10l1.352-1.353a1 1 0 00-1.475-1.475L10 9.432l-1.353-1.352z" clip-rule="evenodd" />
            </svg>
          </div>
          <input
            type="number"
            id="minPrice"
            v-model.number="filterForm.price_min"
            placeholder="Min Price"
            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
          />
        </div>
      </div>

      <div class="flex-1 min-w-[150px] ">
        <label for="maxPrice" class="sr-only">Max Price</label>
        <div class="relative">
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008.08 8.647L9.432 10l-1.352 1.353a1 1 0 001.475 1.475L10.907 10l1.353 1.353a1 1 0 001.475-1.475L12.353 10l1.352-1.353a1 1 0 00-1.475-1.475L10 9.432l-1.353-1.352z" clip-rule="evenodd" />
            </svg>
          </div>
          <input
          type="number"
          id="maxPrice"
          v-model.number="filterForm.price_max"
          placeholder="Max Price"
          class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
          />
        </div>

      </div>

      <div class="flex-1 min-w-[150px]">
        <label for="propertyType" class="sr-only">Property Type</label>
        <div class="relative">
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M9.293 2.293a1 1 0 011.414 0l7 7A1 1 0 0117 11h-1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-3a1 1 0 00-1-1H9a1 1 0 00-1 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-6H3a1 1 0 01-.707-1.707l7-7z" clip-rule="evenodd" />
            </svg>
          </div>
          <select
            id="propertyType"
            v-model="filterForm.propertyType"
            class="block w-full pl-10 pr-10 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
          >
            <option value="">Any Type</option>
            <option value="Rowhouse">Row House</option>
            <option value="Townhouse">Townhouse</option>
            <option value="Single Attached">Single Attached</option>
          </select>
        </div>
      </div>

      <div class="flex flex-grow-0 gap-x-2 sm:mt-0 mt-4">
        <button
          type="button"
          @click="clear"
          class="flex-shrink-0 cursor-pointer px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200"
        >
          Clear
        </button>
        <button
          type="submit"
          class="flex-shrink-0 cursor-pointer px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200"
        >
          Search
        </button>
      </div>
    </form>
  </div>
</template>

<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
  filters: Object,
  properties: Object,
  cities: {
    type: Array,
    default: () => [],
  },
})


const filterForm = useForm({
  price_min: props.filters.price_min ?? "",
  price_max: props.filters.price_max ?? "",
  location: props.filters.location ?? "",
  propertyType: props.filters.propertyType ?? "",
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

const clear =  () => {
  filterForm.price_min = null
  filterForm.price_max = null
  filterForm.location = ""
  filterForm.propertyType = ""
  filter()
}
</script>
