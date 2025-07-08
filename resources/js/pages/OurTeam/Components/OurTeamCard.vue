<template>
    <slot>
     <div class="p-4">
              <div class="text-center">
                <img
                 :src="team.image.startsWith('http') ? team.image : '/storage/' + team.image"

                 :alt="team.name" class="w-40 h-40 rounded-full mx-auto mb-4 shadow-lg object-cover">
                <h3 class="text-xl font-semibold text-gray-800">{{ team.name }}</h3>
                <p class="text-green-600 font-medium">{{ team.job_title }}</p>
                <p class="text-gray-500 mt-2 px-4 text-sm">{{ team.job_description }}</p>
              </div>
    </div>
    </slot>
</template>
<script setup lang="ts">

defineProps({
  team: {
    type: Object,
    required: true
  }
});

</script>
