<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';

import { Head } from '@inertiajs/vue3';
import DynamicForm from '@/components/DynamicForm.vue';
import { z } from 'zod';






const props = defineProps({
  developer: Array,
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
        title: 'Create Project',
        href: '/dashboard',
    },
];


const initialProjectData = {
  name: '',
  address: '',
  developer_id: '', // Set a default value for the select
  city: '',
  province: '',
  google_map_link: '',
  description: '',
};

const projectFields = [
    {
      name: 'developer_id',
      label: 'Project Developer',
      type: 'select',
      placeholder: 'Select project developer',
      options: props.developer.map((dev: any) => ({
        value: dev.id,
        label: dev.name,
      })),
  },
  {
    name: 'name',
    label: 'Project Name',
    type: 'text',
    placeholder: 'Enter project name',

  },
   {
    name: 'description',
    label: 'Project Description',
    type: 'textarea',
    placeholder: 'Enter project description',

  },
  {
    name: 'address',
    label: 'Project Address',
    type: 'textarea',
    placeholder: 'Enter project address',

  },
  {
    name: 'city',
    label: 'Project City',
    type: 'text',
    placeholder: 'Enter project city',

  },
  {
    name: 'province',
    label: 'Project Province',
    type: 'text',
    placeholder: 'Enter project province',

  },
  {
    name: 'google_map_link',
    label: 'Google Map Link',
    type: 'textarea',
    placeholder: 'Enter Google Map link',

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
        <h1 class="text-2xl font-bold ">Create New Project</h1>
        <!-- <p class="text-muted-foreground mb-4">Fill in the details below to create a new project.</p> -->
        <!-- Use the DynamicForm component to handle project creation -->
        <DynamicForm class="text-gray-800"
        :schema="projectSchema"
          :initial-data="initialProjectData"
          :fields="projectFields"
          :submit-route="route('admin.project.store')"
          submit-method="post"
          submit-button-text="Create Project"
          @success="handleProjectCreationSuccess"
        />
      </div>
    </div>
  </AppLayout>
</template>
