<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, router} from '@inertiajs/vue3';

import DynamicForm from '@/components/DynamicForm.vue';

import { z } from 'zod';



const props = defineProps({
  hero: Object,
});


const projectSchema = z.object({
    hero_title: z.string().min(1, 'Hero title is required'),
    hero_description: z.string().min(1, 'Hero description is required'),
    hero_image: z.any().optional(),
});

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: route('admin.dashboard'),
    },
    {
        title:'Heroes' ,
        href: '/dashboard',
    },
];


const initialProjectData = {
    hero_title: props.hero?.hero_title || '',
    hero_description: props.hero?.hero_description || '',
    hero_image: null,
};

const projectFields = [

    {
        name: 'hero_title',
        label: 'Hero Title',
        type: 'textarea',
        placeholder: 'Enter hero title',
    },

    {
        name: 'hero_description',
        label: 'Hero Description',
        type: 'textarea',
        placeholder: 'Enter hero description',
    },
    {
        name: 'hero_image',
        label: 'Hero Background Image',
        type: 'file',
        placeholder: 'Upload an image',
    },
];










import { useFlashToaster } from '@/composables/useFlashToaster';
useFlashToaster();
</script>

<template>
  <Head title="Edit Developer"/>
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex flex-col md:flex-row m-2 md:m-5 gap-5 md:mt-10 justify-center">
      <div class="w-full md:max-w-lg flex flex-col gap-2 rounded-xl p-4 md:p-8 bg-white border border-gray-200 shadow">
        <h1 class="text-2xl font-bold ">Edit Hero Details</h1>
        <p class="text-muted-foreground mb-4"></p>
        <DynamicForm class="text-gray-800"
        :schema="projectSchema"
          :initial-data="initialProjectData"
          :fields="projectFields"
          :submit-route="route('admin.heroes.update', hero?.id)"
          submit-method="post"
          submit-button-text="Update"
          @success="() => router.reload({ only: ['heroes'] })"
          :current-image="hero?.hero_image"
        />
      </div>
    </div>
  </AppLayout>
</template>
