<script setup lang="ts">
import MenuItems from '@/components/MenuItems.vue';
import { usePage } from '@inertiajs/vue3';
import { ref, onMounted, onUnmounted, computed } from 'vue';
import { Youtube } from 'lucide-vue-next';

const navOpen = ref(false);
const isScrolled = ref(false);

const navLinks = ref([
    { title: 'Home', href: 'home.index' },
    { title: 'Properties', href: 'properties.index' },
    { title: 'About Us', href: 'about-us.index' },
    { title: 'Our Team', href: 'our-team.index' },
    { title: 'Contact Us', href: 'contact-us.index' },



]);

const page = usePage();

const facebook = computed(() => page.props.app?.facebook);
const twitter = computed(() => page.props.app?.twitter);
const instagram = computed(() => page.props.app?.instagram);
const youtube = computed(() => page.props.app?.youtube);
const tiktok = computed(() => page.props.app?.tiktok);
const email = computed(() => page.props.app?.email);
const address = computed(() => page.props.app?.address);

const socialLinks = computed(() => [
    {
        name: 'Facebook',
        href: facebook.value,
        icon: `<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>`
    },
    {
        name: 'X',
        href: twitter.value,
        icon: `<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H4.58l4.546 6.072L13.447 2.25h4.797zM17.11 19.35h1.564L6.47 4.2h-1.63l12.27 15.15z" /></svg>`
    },
    {
        name: 'Instagram',
        href: instagram.value,
        icon: `<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.024.06 1.378.06 3.808s-.012 2.784-.06 3.808c-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.024.048-1.378.06-3.808.06s-2.784-.013-3.808-.06c-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.048-1.024-.06-1.378-.06-3.808s.012-2.784.06-3.808c.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 016.08 2.525c.636-.247 1.363-.416 2.427-.465C9.53 2.013 9.884 2 12.315 2zm-1.043 11.23a3.272 3.272 0 116.544 0 3.272 3.272 0 01-6.544 0z" clip-rule="evenodd" /></svg>`
    },
    {
        name: 'YouTube',
        href: youtube.value,
        icon: Youtube,
    },
    {
        name: 'TikTok',
        href: tiktok.value,
        icon: `<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 512 512" id="icons" xmlns="http://www.w3.org/2000/svg"><path d="M412.19,118.66a109.27,109.27,0,0,1-9.45-5.5,132.87,132.87,0,0,1-24.27-20.62c-18.1-20.71-24.86-41.72-27.35-56.43h.1C349.14,23.9,350,16,350.13,16H267.69V334.78c0,4.28,0,8.51-.18,12.69,0,.52-.05,1-.08,1.56,0,.23,0,.47-.05.71,0,.06,0,.12,0,.18a70,70,0,0,1-35.22,55.56,68.8,68.8,0,0,1-34.11,9c-38.41,0-69.54-31.32-69.54-70s31.13-70,69.54-70a68.9,68.9,0,0,1,21.41,3.39l.1-83.94a153.14,153.14,0,0,0-118,34.52,161.79,161.79,0,0,0-35.3,43.53c-3.48,6-16.61,30.11-18.2,69.24-1,22.21,5.67,45.22,8.85,54.73v.2c2,5.6,9.75,24.71,22.38,40.82A167.53,167.53,0,0,0,115,470.66v-.2l.2.2C155.11,497.78,199.36,496,199.36,496c7.66-.31,33.32,0,62.46-13.81,32.32-15.31,50.72-38.12,50.72-38.12a158.46,158.46,0,0,0,27.64-45.93c7.46-19.61,9.95-43.13,9.95-52.53V176.49c1,.6,14.32,9.41,14.32,9.41s19.19,12.3,49.13,20.31c21.48,5.7,50.42,6.9,50.42,6.9V131.27C453.86,132.37,433.27,129.17,412.19,118.66Z"/></svg>`
    }
].filter(s => s.href && String(s.href).trim() !== ''));


// --- Scroll Handling ---
const handleScroll = () => {
    isScrolled.value = window.scrollY > 10;
};

onMounted(() => {
    window.addEventListener('scroll', handleScroll);
    handleScroll(); // Check scroll position on initial load
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});
</script>

<template>
    <header class="text-green-950">
        <div
            :class="isScrolled ? 'bg-white/95 shadow-lg backdrop-blur-sm' : 'bg-white/80'"
            class="fixed w-full top-0 z-50 transition-all duration-300"
        >
            <div
                class="hidden md:block bg-gray-100 border-b border-gray-200/80 overflow-hidden transition-all duration-300 ease-in-out"
                :class="isScrolled ? 'h-0 opacity-0' : 'h-12 md:h-10 opacity-100'"
            >
                <div class="max-w-screen-xl h-full mx-auto px-4 flex items-center justify-between">
                    <div class="hidden md:flex items-center space-x-6 text-sm">
                        <a href="mailto:inquire@tr.com" class="flex items-center text-gray-600 hover:text-green-950 transition-colors">
                            <svg class="h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" /></svg>
                            <span>{{ email }}</span>
                        </a>
                        <div class="flex items-center text-gray-600">
                            <svg class="h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                            <span>{{ address }}</span>
                        </div>
                    </div>

                    <div class="flex items-center space-x-5">
                         <div class="flex items-center space-x-5">
                            <a
                                v-for="social in socialLinks"
                                :key="social.name"
                                  :href="social.href"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="text-gray-500 hover:text-green-950 transition-colors duration-300"
                                :aria-label="`Follow us on ${social.name}`"
                            >
                                <span class="sr-only">{{ social.name }}</span>
                                <div v-if="social.name !== 'YouTube'" v-html="social.icon"></div>
                                <component v-else :is="social.icon" class="h-5 w-5" />
                            </a>
                        </div>
                        <a href="/contact-us" class="px-3 py-1.5 text-sm bg-green-800 text-white rounded-md hover:bg-green-950 font-semibold transition-colors shadow-sm">
                            Inquire Now
                        </a>
                    </div>
                </div>
            </div>

            <nav>
                <div class="max-w-screen-xl mx-auto px-4">
                    <div class="flex items-center justify-between h-20">

                        <div class="flex-shrink-0">
                            <img src="@/images/TR.png" alt="Company Logo" class="h-12 w-auto">
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:space-x-2">
                            <MenuItems v-for="link in navLinks" :key="link.title" :labels="link" />
                        </div>

                        <div class="sm:hidden">
                            <button
                                @click="navOpen = !navOpen"
                                type="button"
                                class="relative z-50 p-2 text-green-950 focus:outline-none"
                                aria-label="Toggle menu"
                            >
                                <div class="w-6 h-6 flex items-center justify-center">
                                    <span
                                        class="absolute h-0.5 w-6 bg-current transform transition duration-300 ease-in-out"
                                        :class="{'rotate-45': navOpen, ' -translate-y-1.5': !navOpen }"
                                    ></span>
                                    <span
                                        class="absolute h-0.5 w-6 bg-current transform transition duration-300 ease-in-out"
                                        :class="{'opacity-0': navOpen }"
                                    ></span>
                                    <span
                                        class="absolute h-0.5 w-6 bg-current transform transition duration-300 ease-in-out"
                                        :class="{' -rotate-45': navOpen, ' translate-y-1.5': !navOpen }"
                                    ></span>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>

                <Transition
                    enter-active-class="transition ease-out duration-300"
                    enter-from-class="transform -translate-y-4 opacity-0"
                    enter-to-class="transform translate-y-0 opacity-100"
                    leave-active-class="transition ease-in duration-200"
                    leave-from-class="transform translate-y-0 opacity-100"
                    leave-to-class="transform -translate-y-4 opacity-0"
                >
                    <div v-if="navOpen" class="sm:hidden absolute top-0 left-0 w-full bg-white shadow-xl pt-24 pb-8">
                        <div class="flex flex-col items-center space-y-4">
                            <MenuItems v-for="link in navLinks" :key="link.title" :labels="link" @click="navOpen = false" />
                        </div>
                    </div>
                </Transition>
            </nav>
        </div>

        <Transition
            enter-active-class="transition-opacity ease-in-out duration-300"
            enter-from-class="opacity-0"
            enter-to-class="opacity-100"
            leave-active-class="transition-opacity ease-in-out duration-300"
            leave-from-class="opacity-100"
            leave-to-class="opacity-0"
        >
            <div v-if="navOpen" @click="navOpen = false" class="sm:hidden fixed inset-0 bg-black/60 z-40"></div>
        </Transition>

    </header>
</template>
