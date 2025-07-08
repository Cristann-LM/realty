<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';

import { Head } from '@inertiajs/vue3';
import DynamicForm from '@/components/DynamicForm.vue';
import { z } from 'zod';






const props = defineProps({
  projects: Array,
});


const projectSchema = z.object({
  name: z.string().min(2).max(100),
  address: z.string().min(5).max(500),
  developer_id: z.string().uuid(),
  city: z.string().min(2).max(100),
  province: z.string().min(2).max(100),
  google_map_link: z.string().url().optional(),
});

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Project',
        href: route('admin.project.index'),
    },
    {
        title: 'Create Unit',
        href: '/dashboard',
    },
];


const initialProjectData = {
    project_id: '', // Set a default value for the select
    name: '',
    type: '',
    price: null,
    floor_area: null,
    lot_area: null,
    bedrooms: null,
    bathrooms: null,
    parking_spaces: null,
};

const projectFields = [
    {
      name: 'project_id',
      label: 'Unit Project',
      type: 'select',
      placeholder: 'Select unit developer',
      options: props.projects.map((proj: any) => ({
        value: proj.id,
        label: `${proj.name} (${proj.city}, ${proj.province})`,
      })),
  },
  {
    name: 'name',
    label: 'Project Unit Name',
    type: 'text',
    placeholder: 'Enter project unit name',

  },
   {
    name: 'type',
    label: 'Project Unit Type',
    type: 'select',
    placeholder: 'Select property type',
    options: [
      { value: 'Rowhouse', label: 'Rowhouse' },
      { value: 'Townhouse', label: 'Townhouse' },
      { value: 'Single Attached', label: 'Single Attached' },
    ],
  },
  {
    name: 'price',
    label: 'Project Unit Price',
    type: 'number',
    placeholder: 'Enter project unit price',

  },
  [
  {
    name: 'floor_area',
    label: 'Unit Floor Area',
    type: 'number',
    placeholder: 'Enter unit floor area',

  },
  {
    name: 'lot_area',
    label: 'Unit Lot Area',
    type: 'number',
    placeholder: 'Enter unit lot area',

  },
],
  {
    name: 'bedrooms',
    label: 'No. of Bedrooms',
    type: 'number',
    placeholder: 'Enter number of bedrooms',

  },
  {
    name: 'bathrooms',
    label: 'No. of Bathrooms',
    type: 'number',
    placeholder: 'Enter number of bathrooms',

  },
  {
    name: 'parking_spaces',
    label: 'No. of Parking Spaces',
    type: 'number',
    placeholder: 'Enter number of parking spaces',

  },

];



const handleProjectCreationSuccess = () => {
  // Optionally handle success, e.g., redirect or show a different message
  // The DynamicForm already shows a toast, but you could add more logic here.
  console.log('Project created successfully!');
  // Inertia.visit(route('admin.project.index')); // Example redirect
};



</script>

<template>
  <Head title="Edit Developer"/>
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex m-5  md:mt-10 justify-center">
      <div class="w-full max-w-lg flex flex-col gap-2 rounded-xl p-8 bg-white border border-gray-200 shadow">
        <h1 class="text-2xl font-bold ">Create New Unit</h1>
        <!-- <p class="text-muted-foreground mb-4">Fill in the details below to create a new project.</p> -->
        <!-- Use the DynamicForm component to handle project creation -->
        <DynamicForm class="text-gray-800"
        :schema="projectSchema"
          :initial-data="initialProjectData"
          :fields="projectFields"
          :submit-route="route('admin.property-units.store')"
          submit-method="post"
          submit-button-text="Create Unit"
          @success="handleProjectCreationSuccess"
        />
      </div>
    </div>
  </AppLayout>
</template>
