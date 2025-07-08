<script setup lang="ts">

import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm,} from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { House } from 'lucide-vue-next';
import { ref } from 'vue';


const props = defineProps({
    images: {
        type: Array,
        required: true
    },
    property: {
        type: Object,
        required: true
    }

})


const breadcrumbs: BreadcrumbItem[] = [
      {
        title: 'Property',
        href: route('admin.property-units.index'),
    },
    {
        title: props.property?.name ?? '',
        href: '/dashboard',
    },

];

import { useFlashToaster } from '@/composables/useFlashToaster';
useFlashToaster();
import { Edit, BuildingIcon,} from 'lucide-vue-next';
import Currency from '@/components/Currency.vue';
import Label from '@/components/ui/label/Label.vue';
import Input from '@/components/ui/input/Input.vue';

const form = useForm({
    images: []
});

const uploadProgress = ref(0);
const previewImages = ref<string[]>([]);
const fileError = ref<string | null>(null);

const upload = () => {
    uploadProgress.value = 0;
    form.post(route('admin.property-units.images.store', { property_unit: props.property.id }), {
        preserveScroll: true,
        preserveState: false, // force reload of props
        onSuccess: () => {
            form.reset('images');
            uploadProgress.value = 0;
        },
        onError: () => {
            uploadProgress.value = 0;
        },
        onProgress: (event: ProgressEvent) => {
            if (event.lengthComputable) {
                uploadProgress.value = Math.round((event.loaded / event.total) * 100);
            }
        },
    })
};

const addFiles = (event: Event) => {
    const files = (event.target as HTMLInputElement).files;
    if (!files) return;
    form.images = [];
    previewImages.value = [];
    fileError.value = null;
    for(const image of files) {
        if (image.size > 2 * 1024 * 1024) {
            fileError.value = 'Each image must not exceed 2MB.';
            continue;
        }
        form.images.push(image);
        previewImages.value.push(URL.createObjectURL(image));
    }
};

const reset = () => {
    form.reset('images');
};

function confirmDelete(imageId: number) {
    if (confirm('Are you sure you want to delete this image?')) {
        form.delete(route('admin.property-units.images.destroy', { property_unit: props.property.id, image: imageId }))
    }
}
const setPrimary = (imageId: number) => {
  console.log('Setting primary image:', imageId);
  form.patch(
    route('admin.property-units.images.primary', {
      property_unit: props.property.id,
      image: imageId,
    }),
    {
      preserveScroll: true,
      onSuccess: () => {
        // Optionally reload images or show a toast
      },
    }
  );
};
</script>

<template>

  <Head title="Developer"/>
  <AppLayout :breadcrumbs="breadcrumbs">

    <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
        <div class="flex flex-col gap-4 mb-4 md:flex-row md:gap-8">
      <!-- Project Details Left -->
      <div class="flex-1 flex flex-col gap-2 bg-white rounded-xl shadow p-4 md:p-6 border border-gray-200">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-2 gap-2">
          <h1 class="text-2xl md:text-3xl font-extrabold text-primary flex items-center gap-2">
            {{ props.property.name }} - {{ props.property.type }}
          </h1>
          <!-- Edit button: hidden on mobile, visible on md+ -->
          <Button
            as="a"
            :href="route('admin.property-units.edit', props.property.id)"
            variant="outline"
            class="ml-0 md:ml-4 flex items-center gap-1 w-full md:w-auto hidden md:flex"
          >
            <Edit class="h-5 w-5 mr-1" />
            Edit
          </Button>
        </div>
        <div class="flex flex-col md:flex-row md:items-center gap-2 text-gray-600">
          <div class="flex items-center gap-2">
            <span class="font-medium">Price:</span>
            <span><Currency :amount="props.property.price" /></span>
          </div>
          <div class="flex items-center gap-2">
            <span class="font-medium">Floor Area:</span>
            <span>{{ props.property.floor_area }}</span>
          </div>
          <div class="flex items-center gap-2">
            <span class="font-medium">Lot Area:</span>
            <span>{{ props.property.lot_area }}</span>
          </div>
        </div>
        <div class="flex flex-col md:flex-row gap-2 mt-2">
          <div class="flex flex-col md:flex-row md:items-center gap-2">
            <span class="flex items-center gap-2"><House class="h-5 w-5" /> {{ props.property.bedrooms }} Bedrooms</span>
            <span class="flex items-center gap-2"><BuildingIcon class="h-5 w-5" /> {{ props.property.bathrooms }} Bathrooms</span>
            <span class="flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><rect x="2" y="7" width="20" height="7" rx="2" stroke="currentColor" stroke-width="2" fill="none"/><path d="M6 21v-4M18 21v-4" stroke="currentColor" stroke-width="2" fill="none"/></svg> {{ props.property.parking_spaces }} Parking Spaces</span>
          </div>
        </div>
        <!-- Edit button: visible only on mobile (below details) -->
        <Button
          as="a"
          :href="route('admin.property-units.edit', props.property.id)"
          variant="outline"
          class="flex items-center gap-1 w-full mt-4 md:hidden"
        >
          <Edit class="h-5 w-5 mr-1" />
          Edit
        </Button>
      </div>

    </div>
    <div class="flex flex-col gap-4 mb-4 md:flex-row md:gap-8">
      <!-- Project Details Left -->
      <div class="flex-1 flex flex-col gap-2 bg-white rounded-xl shadow p-6 border border-gray-200">
        <h1 class="text-2xl font-bold">
            Upload Images
        </h1>
     <form @submit.prevent="upload"
            class="mt-6"
            >
            <Label for="images" class="block mb-2 text-sm font-medium text-gray-700">
            <span class="mb-2 text-sm font-medium text-gray-700">Upload Image</span>
            <Input type="file" @input="addFiles" accept="image/*" multiple class="block cursor-pointer w-.5/3 text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" />
            </Label>
            <div v-if="previewImages.length" class="flex flex-wrap gap-2 mb-4">
              <div v-for="(src, idx) in previewImages" :key="idx" class="w-1/3 lg:w-1/7 h-auto border rounded overflow-hidden flex items-center justify-center">
                <img :src="src" class="object-cover w-full h-full" />
              </div>
            </div>
            <div v-if="fileError" class="text-red-500 text-sm mb-2">
            {{ fileError }}
            </div>
            <div v-if="uploadProgress > 0" class="w-full bg-gray-200 rounded-full h-2.5 mb-4">
              <div class="bg-green-500 h-2.5 rounded-full transition-all duration-300" :style="{ width: uploadProgress + '%' }"></div>
            </div>
            <Button type="submit" class="w-.5/2 mt-2 mr-2 cursor-pointer">
                Upload Image
            </Button>
            <Button type="reset" @click="reset" class="w-.5/2 mt-2 cursor-pointer">
                Reset
            </Button>
        </form>
        <div class="mt-4">
            <h2 class="text-lg font-semibold mb-2">Uploaded Images</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
              <div
                v-for="image in props.images"
                :key="image.id"
                class="relative"
                :class="image.is_primary ? ' ring-green-500' : ''"
              >
                <img :src="image.src" alt="Property Image" class="w-full h-auto object-cover rounded-lg shadow-md" />
                <span
                  v-if="image.is_primary"
                  class="absolute top-2 left-2 bg-green-600 text-white text-xs px-2 py-1 rounded shadow"
                >
                  Primary
                </span>
                <Button
                  @click="confirmDelete(image.id)"
                  class="w-full mt-2 cursor-pointer"
                >
                  Delete
                </Button>
                <Button
                  v-if="!image.is_primary"
                  @click="setPrimary(image.id)"
                  class="w-full mt-2 cursor-pointer"
                  variant="secondary"
                >
                  Set as Primary
                </Button>
              </div>
              <div v-if="props.images.length === 0" class="col-span-5 text-center text-gray-500">
                No images uploaded yet.
              </div>
            </div>
        </div>
        </div>
        </div>
    </div>
  </AppLayout>
</template>
