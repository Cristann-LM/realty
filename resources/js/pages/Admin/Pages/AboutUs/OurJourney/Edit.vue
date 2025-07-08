<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import DynamicForm from '@/components/DynamicForm.vue';
import { z } from 'zod';
import { Head, router,  } from '@inertiajs/vue3';


const props = defineProps({
    journey: {
        type: Object,
        required: true
    }

})

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Developer',
        href: route('admin.dashboard'),
    },
    {
        title: 'About Us',
        href: route('admin.about-us.edit', 1),
    },
    {
        title: props.journey.title,
        href: '/dashboard',
    },
];


const projectSchema = z.object({
    year: z.number().min(2000).max(new Date().getFullYear()),
    title: z.string().min(2).max(100),
    description: z.string().min(10).max(1000),
});
const initialProjectData = {
    year: props.journey.year || '',
    title: props.journey.title || '',
    description: props.journey.description || '',
};



const projectFields = [
    {
        name: 'year',
        label: 'Year',
        type: 'number',
        placeholder: 'Enter year',
    },
    {
        name: 'title',
        label: 'title',
        type: 'text',
        placeholder: 'Enter mission statement',
    },
    {
        name: 'description',
        label: 'Description',
        type: 'textarea',
        placeholder: 'Enter description',
    },
];












</script>

<template>
    <Head title="Edit Developer"/>

     <AppLayout :breadcrumbs="breadcrumbs">
       <div class="flex m-5 gap-5  md:mt-10 justify-center">
      <div class="w-full max-w-lg flex flex-col gap-2 rounded-xl p-8 bg-white border border-gray-200 shadow">
        <div class="flex items-center justify-between">
            <h1 class="text-3xl font-extrabold text-primary flex items-center gap-2">
                Edit Journey
            </h1>
        </div>
        <p class="text-muted-foreground mb-4">Update the journey details.</p>
        <!-- Use the DynamicForm component to handle project creation -->
        <DynamicForm class="text-gray-800"
        :schema="projectSchema"
          :initial-data="initialProjectData"
          :fields="projectFields"
          :submit-route="route('admin.journeys.update', journey?.id)"
          submit-method="put"
          submit-button-text="Update"
          @success="() => router.reload({ only: ['aboutUs'] })"
        />
        </div>
        </div>
    </AppLayout>

</template>
