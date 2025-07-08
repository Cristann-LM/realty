<template>
    <section class="relative h-[50vh] bg-cover bg-center"
    :style="{ backgroundImage: `url('${props.bannerImg}')` }">
      <div class="absolute inset-0 bg-slate-950 opacity-60"></div>
      <div class="relative z-10 flex flex-col items-center justify-center h-full text-white text-center px-4">
       <slot> <h1 class="text-4xl md:text-6xl font-bold leading-tight mb-4">Your Trusted Partner in Real Estate</h1>
        <p class="text-lg md:text-xl max-w-3xl">Discover a seamless and rewarding property journey with a team that cares.</p>
        </slot>
      </div>
    </section>
</template>
<script setup lang="ts">

    const  props = defineProps({
        bannerImg: {
            type: String,
            default: './images/BNNR6.jpg'
        }
    });

</script>
