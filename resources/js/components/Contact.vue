<template>
  <div class="bg-slate-50 font-sans animate-fade-in-up">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24">

      <div class="grid grid-cols-1 lg:grid-cols-2 lg:gap-16">

        <div class="space-y-12">

          <div>
            <h2 class="text-2xl font-bold text-slate-800">Contact Information</h2>
            <dl class="mt-6 space-y-4 text-slate-700">
              <div class="flex items-start">
                <dt class="flex-shrink-0">
                  <span class="sr-only">Address</span>
                  <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                </dt>
                <dd class="ml-3">
                  <p>{{ contact?.address }}</p>
                </dd>
              </div>
              <div class="flex items-start">
                <dt class="flex-shrink-0">
                  <span class="sr-only">Phone number</span>
                  <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 6.75z" /></svg>
                </dt>
                <dd class="ml-3">
                  <a href="tel:+63464811000" class="hover:text-indigo-600 transition-colors">{{ contact?.phone }}</a>
                </dd>
              </div>
              <div class="flex items-start">
                <dt class="flex-shrink-0">
                  <span class="sr-only">Email</span>
                  <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" /></svg>
                </dt>
                <dd class="ml-3">
                  <a href="mailto:contact@example.com" class="hover:text-indigo-600 transition-colors">{{ contact?.email }}</a>
                </dd>
              </div>
            </dl>
          </div>

          <div>
            <h2 class="text-2xl font-bold text-slate-800">Our Location</h2>
            <div class="mt-6 aspect-[16/9] w-full rounded-lg overflow-hidden shadow-md">
              <div v-html="contact?.google_map" class="w-full h-full"></div>
            </div>
          </div>
        </div>

        <div class="bg-white p-8 sm:p-12 rounded-lg shadow-lg">
          <h2 class="text-2xl font-bold text-slate-800">Send us a message</h2>
          <form @submit.prevent="handleSubmit" class="mt-6 space-y-6">
            <div>
              <label for="name" class="block text-sm font-medium text-slate-700">Full Name</label>
              <div class="mt-1">
                <input v-model="formData.name" type="text" name="name" id="name" autocomplete="name" required
                  class="block w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-3">
              </div>
            </div>
            <div>
              <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
              <div class="mt-1">
                <input v-model="formData.email" id="email" name="email" type="email" autocomplete="email" required
                  class="block w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-3">
              </div>
            </div>
            <div>
              <label for="message" class="block text-sm font-medium text-slate-700">Message</label>
              <div class="mt-1">
                <textarea v-model="formData.message" id="message" name="message" rows="4" required
                  class="block w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-3"></textarea>
              </div>
            </div>
            <div>
              <button type="submit" :disabled="submitting"
                class="w-full flex justify-center cursor-pointer items-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 disabled:bg-green-400 disabled:cursor-not-allowed transition-colors">
                <span v-if="!submitting">Send Message</span>
                <svg v-if="submitting" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
              </button>
              <Transition
                  enter-active-class="transition ease-out duration-200"
                  enter-from-class="transform opacity-0 translate-y-2"
                  enter-to-class="transform opacity-100 translate-y-0"
                  leave-active-class="transition ease-in duration-150"
                  leave-from-class="transform opacity-100 translate-y-0"
                  leave-to-class="transform opacity-0 translate-y-2"
                >
                <p v-if="submissionStatus === 'success'" class="mt-4 text-center text-sm font-medium text-green-600">
                  Thank you! Your message has been sent successfully.
                </p>
                <p v-else-if="submissionStatus === 'error'" class="mt-4 text-center text-sm font-medium text-red-600">
                  Something went wrong. Please check your details and try again.
                </p>
              </Transition>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

interface ContactData {
  address?: string;
  phone?: string;
  email?: string;
  facebook?: string;
  instagram?: string;
  twitter?: string;
  google_map?: string; // This will hold the full iframe HTML string
}

defineProps<{
  contact?: ContactData;
}>();

// Reactive state for form inputs
const formData = ref({
  name: '',
  email: '',
  message: '',
});

// Reactive state for form submission status
const submitting = ref(false);
const submissionStatus = ref<'success' | 'error' | null>(null);

const handleSubmit = () => {
  submitting.value = true;
  submissionStatus.value = null;

  router.post(
    route('inquiry.store'), // Replace with your actual route name or URL
    formData.value,
    {
      onSuccess: () => {
        submissionStatus.value = 'success';
        formData.value = { name: '', email: '', message: '' };
      },
      onError: () => {
        submissionStatus.value = 'error';
      },
      onFinish: () => {
        submitting.value = false;
      },
    }
  );
};

import { useFlashToaster } from '@/composables/useFlashToaster';
useFlashToaster();
</script>

<style scoped>
@keyframes fade-in-up {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-fade-in-up {
  animation: fade-in-up 0.7s ease-out forwards;
}
</style>
