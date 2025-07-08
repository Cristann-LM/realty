<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';

import { Head} from '@inertiajs/vue3';
import DynamicForm from '@/components/DynamicForm.vue';
import { z } from 'zod';







const props = defineProps({
  projects: Array,
  property: Object,
});


const projectSchema = z.object({
    project_id: z.string().uuid(),
    name: z.string().min(2).max(100),
    type: z.string().min(2).max(100),
    price: z.number().min(0),
    floor_area: z.number().min(0),
    lot_area: z.number().min(0).optional(),
    bedrooms: z.number().min(0),
    bathrooms: z.number().min(0),
    parking_spaces: z.number().min(0).optional(),
});

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Properties',
        href: route('admin.property-units.index'),
    },
    {
        title: props.property?.name ?? '',
        href: '/dashboard',
    },
];


const initialProjectData = {
      project_id: props.property?.project_id || null, // Set a default value for the select
    name: props.property?.name || '',
    type: props.property?.type || '',
    price: props.property?.price || null,
    floor_area: props.property?.floor_area || null,
    lot_area: props.property?.lot_area || null,
    bedrooms: props.property?.bedrooms || null,
    bathrooms: props.property?.bathrooms || null,
    parking_spaces: props.property?.parking_spaces || null,
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

  console.log('Project created successfully!');
  // Inertia.visit(route('admin.project.index')); // Example redirect
};



</script>

<template>
  <Head title="Edit Developer"/>
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex m-5  md:mt-10 justify-center">
      <div class="w-full max-w-lg flex flex-col gap-2 rounded-xl p-8 bg-white border border-gray-200 shadow">
        <h1 class="text-2xl font-bold ">Update Unit</h1>
        <!-- <p class="text-muted-foreground mb-4">Fill in the details below to create a new project.</p> -->
        <!-- Use the DynamicForm component to handle project creation -->
        <DynamicForm class="text-gray-800"
        :schema="projectSchema"
          :initial-data="initialProjectData"
          :fields="projectFields"
          :submit-route="route('admin.property-units.update', property?.id)"
          submit-method="put"
          submit-button-text="Update"
          @success="handleProjectCreationSuccess"
        />
      </div>
    </div>
  </AppLayout>
</template>
