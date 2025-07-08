<script setup lang="ts">
import { ref, watch, computed, onMounted, onUnmounted } from 'vue';

// Define props and emits for v-model compatibility
const props = defineProps<{
  options: { value: any; text: string }[];
  modelValue: any;
}>();

const emit = defineEmits(['update:modelValue']);

const isOpen = ref(false);
const selectRef = ref<HTMLElement | null>(null);

// Find the text of the currently selected option
const selectedText = computed(() => {
  const selected = props.options.find(option => option.value === props.modelValue);
  return selected ? selected.text : props.options[0]?.text;
});

// Function to select an option
const selectOption = (value: any) => {
  emit('update:modelValue', value);
  isOpen.value = false;
};

// Close dropdown when clicking outside
const closeOnOutsideClick = (event: MouseEvent) => {
  if (selectRef.value && !selectRef.value.contains(event.target as Node)) {
    isOpen.value = false;
  }
};

onMounted(() => {
  document.addEventListener('click', closeOnOutsideClick);
});

onUnmounted(() => {
  document.removeEventListener('click', closeOnOutsideClick);
});
</script>

<template>
  <div class="relative w-full" ref="selectRef">
    <button
      type="button"
      @click="isOpen = !isOpen"
      class="relative w-full cursor-pointer bg-transparent text-white focus:outline-none focus:ring-0 border-0 p-0 text-left flex items-center"
    >
      <span class="block truncate">{{ selectedText }}</span>
      <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
          <path fill-rule="evenodd" d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.24a.75.75 0 011.06.04l2.7 2.92 2.7-2.92a.75.75 0 011.12 1.004l-3.25 3.5a.75.75 0 01-1.12 0l-3.25-3.5a.75.75 0 01.06-1.004z" clip-rule="evenodd" />
        </svg>
      </span>
    </button>

    <Transition
      enter-active-class="transition ease-out duration-100"
      enter-from-class="transform opacity-0 scale-95"
      enter-to-class="transform opacity-100 scale-100"
      leave-active-class="transition ease-in duration-75"
      leave-from-class="transform opacity-100 scale-100"
      leave-to-class="transform opacity-0 scale-95"
    >
      <ul
        v-if="isOpen"
        class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
      >
        <li
          v-for="option in options"
          :key="option.value"
          @click="selectOption(option.value)"
          :class="[
            'relative cursor-pointer select-none py-2 pl-3 pr-9 text-gray-900 hover:bg-indigo-600 hover:text-white',
            { 'bg-indigo-600 text-white': modelValue === option.value }
          ]"
        >
          <span class="block truncate">{{ option.text }}</span>
          <span v-if="modelValue === option.value" class="absolute inset-y-0 right-0 flex items-center pr-4">
            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
            </svg>
          </span>
        </li>
      </ul>
    </Transition>
  </div>
</template>
