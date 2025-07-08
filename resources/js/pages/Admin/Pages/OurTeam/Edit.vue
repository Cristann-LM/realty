<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';

import { Head, } from '@inertiajs/vue3';
import DynamicForm from '@/components/DynamicForm.vue';
import { z } from 'zod';







const props = defineProps({
  teamMember: Object,
});


const projectSchema = z.object({
    name: z.string().min(2).max(100),
    job_title: z.string().min(2).max(100),
    job_description: z.string().min(5).max(500),
    image: z.string().url().optional(),
});

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Our Team',
        href: route('admin.our-team.index'),
    },
    {
        title: props.teamMember?.name ?? '',
        href: '/dashboard',
    },
];


const initialProjectData = {
    name: props.teamMember?.name ?? '',
    job_title: props.teamMember?.job_title ?? '',
    job_description: props.teamMember?.job_description ?? '',
    image: null,
};

const projectFields = [
     {
    name: 'name',
    label: 'Team Member Name',
    type: 'text',
    placeholder: 'Enter team member name',

  },
   {
    name: 'job_title',
    label: 'Job Title',
    type: 'text',
    placeholder: 'Enter job title',

  },
  {
    name: 'job_description',
    label: 'Job Description',
    type: 'textarea',
    placeholder: 'Enter job description',

  },
  {
    name: 'image',
    label: 'Team Member Image',
    type: 'file',
    placeholder: 'Upload team member image',

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
        <h1 class="text-2xl font-bold ">Update Project</h1>
        <!-- <p class="text-muted-foreground mb-4">Fill in the details below to create a new project.</p> -->
        <!-- Use the DynamicForm component to handle project creation -->
        <DynamicForm class="text-gray-800"
        :schema="projectSchema"
          :initial-data="initialProjectData"
          :fields="projectFields"
          :submit-route="route('admin.our-team.update', props.teamMember?.id)"
          submit-method="post"
          submit-button-text="Update"
          @success="handleProjectCreationSuccess"
          :current-image="props.teamMember?.image"
        />
      </div>
    </div>
  </AppLayout>
</template>
