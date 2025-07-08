<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';

import { Head} from '@inertiajs/vue3';
import DynamicForm from '@/components/DynamicForm.vue';
import { z } from 'zod';







const props = defineProps({
  contactUs: Object,
});


const projectSchema = z.object({
    Address: z.string().min(2).max(1000),
    email: z.string().min(2).max(1000),
    phone: z.string().min(2).max(1000),
    facebook: z.string().min(2).max(1000),
    instagram: z.string().min(2).max(1000),
    twitter: z.string().min(2).max(1000),
    google_map: z.string().min(2).max(1000),
    youtube: z.string().min(2).max(1000).optional(),
    tiktok: z.string().min(2).max(1000).optional(),

});

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Properties',
        href: route('admin.property-units.index'),
    },
    {
        title: 'Contact Us',
        href: '/dashboard',
    },
];


const initialProjectData = {
      address: props.contactUs?.address || null, // Set a default value for the select
    email: props.contactUs?.email || '',
    phone: props.contactUs?.phone || '',
    facebook: props.contactUs?.facebook || null,
    twitter: props.contactUs?.twitter || null,
    instagram: props.contactUs?.instagram || null,
    google_map: props.contactUs?.google_map || null,
    youtube: props.contactUs?.youtube || null,
    tiktok: props.contactUs?.tiktok || null,

};

const projectFields = [
   {
       name: 'address',
    label: 'Address',
    type: 'text',
    placeholder: 'Enter company address',
  },
  {
    name: 'email',
    label: 'Email',
    type: 'text',
    placeholder: 'Enter company email',

  },
   {
    name: 'phone',
    label: 'Contact Number',
    type: 'text',
    placeholder: 'Enter company number',
  },
  {
    name: 'facebook',
    label: 'Facebook',
    type: 'text',
    placeholder: 'Enter company facebook',
  },

  {
    name: 'twitter',
    label: 'Twitter',
    type: 'text',
    placeholder: 'Enter company twitter',

  },
  {
    name: 'instagram',
    label: 'Instagram',
    type: 'text',
    placeholder: 'Enter company instagram',

  },
  {
    name: 'youtube',
    label: 'YouTube',
    type: 'text',
    placeholder: 'Enter company YouTube',
  },
  {
    name: 'tiktok',
    label: 'TikTok',
    type: 'text',
    placeholder: 'Enter company TikTok',
  },
  {
    name: 'google_map',
    label: 'Google Map',
    type: 'textarea',
    placeholder: 'Enter google map',

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
        <h1 class="text-2xl font-bold ">Update Contact Us</h1>
        <p class="text-muted-foreground mb-4">Fill in the details below to create a new project.</p>
        <!-- Use the DynamicForm component to handle project creation -->
        <DynamicForm class="text-gray-800"
        :schema="projectSchema"
          :initial-data="initialProjectData"
          :fields="projectFields"
          :submit-route="route('admin.contact-us.update', contactUs?.id)"
          submit-method="put"
          submit-button-text="Update"
          @success="handleProjectCreationSuccess"
        />
      </div>
    </div>
  </AppLayout>
</template>
