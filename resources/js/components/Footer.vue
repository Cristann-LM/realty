<script setup   lang="ts">
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { Youtube } from 'lucide-vue-next';

const page = usePage();

const facebook = computed(() => page.props.app?.facebook);
const twitter = computed(() => page.props.app?.twitter);
const instagram = computed(() => page.props.app?.instagram);
const youtube = computed(() => page.props.app?.youtube);
const tiktok = computed(() => page.props.app?.tiktok);
const email = computed(() => page.props.app?.email);
const address = computed(() => page.props.app?.address);
const phone = computed(() => page.props.app?.phone);
</script>

<template>
  <footer class="bg-green-950 text-gray-300 pt-16 pb-8">
    <div class="container mx-auto px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">

        <div class="col-span-1 md:col-span-2 lg:col-span-1">
          <h3 class="text-2xl font-bold text-white mb-4">Twin Real Estate</h3>
          <p class="mb-6 text-gray-400"></p>
          <div>
            <label for="newsletter-email" class="block text-sm font-medium text-gray-400 mb-2">Stay Updated</label>
            <div class="flex">
              <input type="email" id="newsletter-email" placeholder="Your email address" class="w-full px-4 py-2 text-gray-800 bg-gray-100 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500">
              <button class="bg-green-600 cursor-pointer text-white px-4 py-2 rounded-r-md hover:bg-green-700 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
              </button>
            </div>
          </div>
        </div>

        <div>
          <h4 class="text-lg font-semibold text-white mb-4">Quick Links</h4>
          <ul class="space-y-3">
            <li><a :href="route('properties.index')" target="_blank" class="hover:text-white transition-colors">All Properties</a></li>
            <li><a :href="route('our-team.index')" target="_blank" class="hover:text-white transition-colors">Our Team</a></li>
            <li><a :href="route('contact-us.index')" target="_blank" class="hover:text-white transition-colors">Contact Us</a></li>
            <li><a :href="route('about-us.index')" target="_blank" class="hover:text-white transition-colors">About Us</a></li>
          </ul>
        </div>
        <div>
          <h4 class="text-lg font-semibold text-white mb-4">Contact Us</h4>
          <ul class="space-y-3">
            <li class="flex items-start">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 mt-1 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
              <span>{{ address }}</span>
            </li>
            <li class="flex items-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
              </svg>
              <a href="tel:+631234567890" class="hover:text-white transition-colors">{{  phone }}</a>
            </li>
            <li class="flex items-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
              </svg>
              <a href="" class="hover:text-white transition-colors">{{ email }}</a>
            </li>
          </ul>
        </div>

        <div>
          <h4 class="text-lg font-semibold text-white mb-4">Follow Us</h4>
          <div class="flex space-x-4 mb-6">
            <a v-if="facebook && facebook.trim()" :href="facebook" target="_blank" class="text-gray-400 hover:text-white transition-colors">
              <span class="sr-only">Facebook</span>
              <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
              </svg>
            </a>
            <a v-if="instagram && instagram.trim()" :href="instagram" target="_blank" class="text-gray-400 hover:text-white transition-colors">
              <span class="sr-only">Instagram</span>
              <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.024.06 1.378.06 3.808s-.012 2.784-.06 3.808c-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.024.048-1.378.06-3.808.06s-2.784-.013-3.808-.06c-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.048-1.024-.06-1.378-.06-3.808s.012-2.784.06-3.808c.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 016.08 2.525c.636-.247 1.363-.416 2.427-.465C9.53 2.013 9.884 2 12.315 2zm-1.043 11.23a3.272 3.272 0 116.544 0 3.272 3.272 0 01-6.544 0z" clip-rule="evenodd" />
              </svg>
            </a>
            <a v-if="twitter && twitter.trim()" :href="twitter" target="_blank" class="text-gray-400 hover:text-white transition-colors">
                <span class="sr-only">X</span>
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" >
                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H4.58l4.546 6.072L13.447 2.25h4.797zM17.11 19.35h1.564L6.47 4.2h-1.63l12.27 15.15z" />
                </svg>
            </a>
            <a v-if="youtube && youtube.trim()" :href="youtube" target="_blank" class="text-gray-400 hover:text-white transition-colors">
              <span class="sr-only">YouTube</span>
              <Youtube />
            </a>
            <a v-if="tiktok && tiktok.trim()" :href="tiktok" target="_blank" class="text-gray-400 hover:text-white transition-colors">
              <span class="sr-only">TikTok</span>
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 512 512" id="icons" xmlns="http://www.w3.org/2000/svg"><path d="M412.19,118.66a109.27,109.27,0,0,1-9.45-5.5,132.87,132.87,0,0,1-24.27-20.62c-18.1-20.71-24.86-41.72-27.35-56.43h.1C349.14,23.9,350,16,350.13,16H267.69V334.78c0,4.28,0,8.51-.18,12.69,0,.52-.05,1-.08,1.56,0,.23,0,.47-.05.71,0,.06,0,.12,0,.18a70,70,0,0,1-35.22,55.56,68.8,68.8,0,0,1-34.11,9c-38.41,0-69.54-31.32-69.54-70s31.13-70,69.54-70a68.9,68.9,0,0,1,21.41,3.39l.1-83.94a153.14,153.14,0,0,0-118,34.52,161.79,161.79,0,0,0-35.3,43.53c-3.48,6-16.61,30.11-18.2,69.24-1,22.21,5.67,45.22,8.85,54.73v.2c2,5.6,9.75,24.71,22.38,40.82A167.53,167.53,0,0,0,115,470.66v-.2l.2.2C155.11,497.78,199.36,496,199.36,496c7.66-.31,33.32,0,62.46-13.81,32.32-15.31,50.72-38.12,50.72-38.12a158.46,158.46,0,0,0,27.64-45.93c7.46-19.61,9.95-43.13,9.95-52.53V176.49c1,.6,14.32,9.41,14.32,9.41s19.19,12.3,49.13,20.31c21.48,5.7,50.42,6.9,50.42,6.9V131.27C453.86,132.37,433.27,129.17,412.19,118.66Z"/></svg>
            </a>
          </div>
          <div class="flex items-center">
               <div>
              <p class="font-semibold text-sm">Brokerage License</p>
              <p class="text-xs text-gray-400">#123456789</p>
            </div>
          </div>
        </div>

      </div>

      <div class="mt-12 pt-8 border-t border-gray-700 text-center text-sm">
        <p class="text-gray-400">&copy; {{ new Date().getFullYear() }} Twin Real Estate Marketing Inc. All Rights Reserved.</p>
        <div class="mt-4 space-x-6">
          <a href="/privacy-policy" class="hover:text-white transition-colors">Privacy Policy</a>
          <span>&middot;</span>
          <a href="/terms-of-service" class="hover:text-white transition-colors">Terms of Service</a>
        </div>
      </div>
    </div>
  </footer>
</template>

