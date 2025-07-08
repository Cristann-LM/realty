<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, router, useForm } from '@inertiajs/vue3';
import { h, ref } from 'vue';
import DynamicForm from '@/components/DynamicForm.vue';
import DataTableDemoColumn from '@/components/DataTableDemoColumn.vue';
import { z } from 'zod';
import DataTable from '@/components/DataTable.vue'
import { ColumnDef } from '@tanstack/vue-table';
import Checkbox from '@/components/ui/checkbox/Checkbox.vue';
import Button from '@/components/ui/button/Button.vue';
import { ArrowUpDown } from 'lucide-vue-next';
import DialogForm from '@/components/DialogForm.vue';


const props = defineProps({
  aboutUs: Object,
    journey: Array,
});


const projectSchema = z.object({
    description: z.string().min(10).max(1000),
    mission: z.string().min(10).max(500),
    vision: z.string().min(10).max(500),
    image: z.any().optional(),
});

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: route('admin.dashboard'),
    },
    {
        title:'About Us' ,
        href: '/dashboard',
    },
];


const initialProjectData = {
    description: props.aboutUs?.description || '',
    mission: props.aboutUs?.mission || '',
    vision: props.aboutUs?.vision || '',
    image:  null, // Assuming image is a URL or null
};

const projectFields = [
    {
        name: 'description',
        label: 'About the company',
        type: 'textarea',
        placeholder: 'Enter description',
    },
    {
        name: 'mission',
        label: 'Mission',
        type: 'textarea',
        placeholder: 'Enter mission statement',
    },

    {
        name: 'vision',
        label: 'Vision',
        type: 'textarea',
        placeholder: 'Enter vision statement',
    },
    {
        name: 'image',
        label: 'Image',
        type: 'file',
        placeholder: 'Upload an image',
    },
];





const columns: ColumnDef<any>[] = [
  {
    id: 'select',
    header: ({ table }) => h(Checkbox, {
      'modelValue': table.getIsAllPageRowsSelected() || (table.getIsSomePageRowsSelected() && 'indeterminate'),
      'onUpdate:modelValue': value => table.toggleAllPageRowsSelected(!!value),
      'ariaLabel': 'Select all',
    }),
    cell: ({ row }) => h(Checkbox, {
      'modelValue': row.getIsSelected(),
      'onUpdate:modelValue': value => row.toggleSelected(!!value),
      'ariaLabel': 'Select row',
    }),
    enableSorting: false,
    enableHiding: false,
  },
    {
    accessorKey: 'year',
    header: ({ column }) => {
      return h(Button, {
        variant: 'ghost',
        onClick: () => column.toggleSorting(column.getIsSorted() === 'asc'),
        }, () => ['Year', h(ArrowUpDown, { class: 'ml-2 h-4 w-4' })])
    },
    cell: ({ row }) => h('div', { class: '' }, row.getValue('year')),
  },
  {
    accessorKey: 'title',
    header: ({ column }) => {
      return h(Button, {
        variant: 'ghost',
        onClick: () => column.toggleSorting(column.getIsSorted() === 'asc'),
        }, () => ['Title', h(ArrowUpDown, { class: 'ml-2 h-4 w-4' })])
    },
    cell: ({ row }) => h('div', { class: '' }, row.getValue('title')),
  },
{

  id: 'actions',
  enableHiding: false,
 cell: ({ row }) => h(DataTableDemoColumn, {
  row: row.original,
  actions: [
    {
      label: 'Edit',
      type: 'link',
      href: route('admin.journeys.edit', row.original.id),
    },
    {
      label: 'Delete',
      danger: true,
      onClick: () => { handleDelete(row.original); },
    }
  ]
}),
}
]

function handleDelete(row: any) {
  if (confirm('Are you sure you want to delete this developer?')) {
    router.delete(route('admin.journeys.destroy', row.id), {
      preserveScroll: true,
      onSuccess: () => {

      },
      onError: () => {

      }
    });
  }
}

const dialogOpen = ref(false)

const form = useForm({
    title: '',
    year: '',
    description: '',

});

const create = () => form.post(route('admin.journeys.store'), {
    preserveScroll: true, // keeps scroll position
    onSuccess: () => {
      form.reset()
      dialogOpen.value = false // Close the dialog
    },
    onError: () => {
        console.error('Error creating journey:', form.errors);
    },
})

import { useFlashToaster } from '@/composables/useFlashToaster';
useFlashToaster();
</script>

<template>
  <Head title="Edit Developer"/>
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex flex-col md:flex-row m-2 md:m-5 gap-5 md:mt-10 justify-center">
      <div class="w-full md:max-w-lg flex flex-col gap-2 rounded-xl p-4 md:p-8 bg-white border border-gray-200 shadow">
        <h1 class="text-2xl font-bold ">Edit Details</h1>
        <p class="text-muted-foreground mb-4">Update the company details.</p>
        <DynamicForm class="text-gray-800"
        :schema="projectSchema"
          :initial-data="initialProjectData"
          :fields="projectFields"
          :submit-route="route('admin.about-us.update', aboutUs?.id)"
          submit-method="post"
          submit-button-text="Update"
          @success="() => router.reload({ only: ['aboutUs'] })"
          :current-image="aboutUs?.image"
        />
      </div>

      <div class="w-full md:max-w-2xl flex flex-col gap-2 rounded-xl p-4 md:p-8 bg-white border border-gray-200 shadow">
         <h1 class="text-2xl font-bold ">Our Journey</h1>
        <p class="text-muted-foreground mb-4">Manage the journey of the company.</p>
         <div class="flex flex-col md:flex-row justify-between items-center gap-2 mb-2">

         <DialogForm
            v-model:open="dialogOpen"
            title="Add Journey"
            description="Add a new Journey to your company. Click save when you're done."
            :form="form"
            :loading="form.processing"
            :fields="[
                { label: 'Title', name: 'title', placeholder: 'Enter title' },
                { label: 'Year', name: 'year', type: 'number', placeholder: 'Enter year' },
                { label: 'Description', type: 'textarea' , name: 'description', placeholder: 'Enter description' },
                ]"
            @submit="create"
            >
            <template #trigger>
                <Button class="cursor-pointer w-full md:w-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add Journey</Button>
            </template>
        </DialogForm>
      </div>
        <DataTable :key="props.journey?.length" :data="props.journey" :columns="columns" filter-key="title" />
      </div>
    </div>
  </AppLayout>
</template>
