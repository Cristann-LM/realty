<script setup lang="ts">

import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, router } from '@inertiajs/vue3';
import { h, ref, watch } from 'vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { ArrowUpDown } from 'lucide-vue-next';





const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Developer',
        href: '/dashboard',
    },
];

const props = defineProps({
    developer: {
        type: Array,
        required: true
    }

})

import DataTable from '@/components/DataTable.vue'

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
    accessorKey: 'name',
    header: ({ column }) => {
      return h(Button, {
        variant: 'ghost',
        onClick: () => column.toggleSorting(column.getIsSorted() === 'asc'),
      }, () => ['Developer Name', h(ArrowUpDown, { class: 'ml-2 h-4 w-4' })])
    },
    cell: ({ row }) => h('div', { class: '' }, row.getValue('name')),
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
      href: route('admin.developer.edit', row.original.id),
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
    router.delete(route('admin.developer.destroy', row.id), {
      preserveScroll: true,
      onSuccess: () => {

      },
      onError: () => {

      }
    });
  }
}


import { ColumnDef } from '@tanstack/vue-table';

import { useForm } from '@inertiajs/vue3'
import DataTableDemoColumn from '@/components/DataTableDemoColumn.vue';
import DialogForm from '@/components/DialogForm.vue';
const dialogOpen = ref(false)

const form = useForm({
    name: '',
})

const create = () => form.post(route('admin.developer.store'), {
    preserveScroll: true, // keeps scroll position
    onSuccess: () => {
      form.reset()
      dialogOpen.value = false // Close the dialog
    },
    onError: () => {

    },
})

import { useFlashToaster } from '@/composables/useFlashToaster';
useFlashToaster();
</script>

<template>
  <!-- Removed Dialog alert, now using toast -->
  <Head title="Developer"/>
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
      <div class="flex justify-between items-center">
        <p class="text-muted-foreground">Manage your properties here.</p>
        <DialogForm
            v-model:open="dialogOpen"
            title="Add developer"
            description="Add a new developer to your project. Click save when you're done."
            :form="form"
            :loading="form.processing"
            :fields="[{ label: 'Developer', name: 'name', placeholder: 'Enter developer name' }]"
            @submit="create"
            >
            <template #trigger>
                <Button class="cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add Developer</Button>
            </template>
        </DialogForm>
      </div>
      <DataTable :key="props.developer.length" :data="props.developer" :columns="columns" filter-key="name" />
    </div>
  </AppLayout>

</template>
