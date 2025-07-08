<!-- filepath: resources/js/Pages/About.vue -->
<template>
  <div class="relative min-h-screen flex items-center justify-center">
    <!-- Background Image -->
    <div
      class="absolute inset-0 bg-cover bg-center"
      :style="{
        backgroundImage: 'url(https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1200&q=80)'
      }"
    ></div>
    <!-- Overlay -->
    <div class="absolute inset-0 bg-blue-900 bg-opacity-60"></div>
    <!-- Content -->
    <div class="relative z-10 max-w-3xl mx-auto p-8 md:p-16 bg-white bg-opacity-90 rounded-3xl shadow-2xl">
      <h1 class="text-4xl md:text-5xl font-extrabold text-blue-900 mb-6 text-center">About Us</h1>
      <p class="text-lg text-gray-700 mb-4 text-center">
        Welcome to <span class="font-semibold text-blue-700">Realty</span> — your trusted partner in finding the perfect home. With years of experience, we connect people with beautiful spaces, whether you’re buying, selling, or renting.
      </p>
      <p class="text-gray-600 mb-6 text-center">
        Our dedicated team is passionate about delivering personalized service and expert guidance. We believe in building lasting relationships and making your real estate journey seamless and enjoyable.
      </p>
      <div class="flex flex-col md:flex-row justify-center gap-6 mt-8">
        <a href="/properties" class="bg-blue-600 text-white px-6 py-2 rounded-full font-semibold shadow hover:bg-blue-700 transition">Browse Properties</a>
        <a href="/contact" class="bg-white border border-blue-600 text-blue-600 px-6 py-2 rounded-full font-semibold hover:bg-blue-50 transition">Contact Us</a>
      </div>
      <div class="mt-12 flex flex-col md:flex-row justify-center gap-8 text-center">
        <div>
          <span class="text-3xl">🤝</span>
          <h3 class="font-semibold text-blue-700 mt-2">Integrity</h3>
          <p class="text-gray-500 text-sm">Honest, transparent, and ethical in all we do.</p>
        </div>
        <div>
          <span class="text-3xl">🏡</span>
          <h3 class="font-semibold text-blue-700 mt-2">Passion</h3>
          <p class="text-gray-500 text-sm">We love helping people find their perfect space.</p>
        </div>
        <div>
          <span class="text-3xl">🌟</span>
          <h3 class="font-semibold text-blue-700 mt-2">Excellence</h3>
          <p class="text-gray-500 text-sm">Committed to top-tier service and results.</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
// No script logic needed for this static page
</script>
