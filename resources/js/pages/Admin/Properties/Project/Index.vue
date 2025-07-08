<script setup lang="ts">

import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, router } from '@inertiajs/vue3';
import { h, } from 'vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { ArrowUpDown } from 'lucide-vue-next';



const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Project',
        href: '/dashboard',
    },

];

const props = defineProps({
    project: {
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
  accessorKey: 'developer.name',
  header: ({ column }) => {
    return h(Button, {
      variant: 'ghost',
      onClick: () => column.toggleSorting(column.getIsSorted() === 'asc'),
    }, () => ['Developer Name', h(ArrowUpDown, { class: 'ml-2 h-4 w-4' })])
  },
  cell: ({ row }) => {
    const developer = row.original.developer
    return h('div', { class: 'capitalize' }, developer ? `${developer.name}` : '')
  },
  filterFn: (row, value) => {
    const developer = row.original.developer
    if (!developer) return false
    const search = value.toLowerCase()
    return (
      developer.name?.toLowerCase().includes(search)
    )
  },
},
    {
    accessorKey: 'name',
    header: ({ column }) => {
      return h(Button, {
        variant: 'ghost',
        onClick: () => column.toggleSorting(column.getIsSorted() === 'asc'),
      }, () => ['Project Name', h(ArrowUpDown, { class: 'ml-2 h-4 w-4' })])
    },
    cell: ({ row }) => h('div', { class: '' }, row.getValue('name')),
  },
  {
  accessorKey: 'address',
   header: 'Address',
  cell: ({ row }) => {
  const project = row.original
  return h('div', { class: 'capitalize' }, project ? `${project.address} ${project.city}, ${project.province}` : '')
},
},

{

  id: 'actions',
  enableHiding: false,
 cell: ({ row }) => h(DataTableDemoColumn, {
  row: row.original,
  actions: [
     {
      label: 'View Details',
      type: 'link',
      href: route('admin.project.show', row.original.id),
    },
    {
      label: 'Edit',
      type: 'link',
      href: route('admin.project.edit', row.original.id),
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
  if (confirm('Are you sure you want to delete this project?')) {
    router.delete(route('admin.project.destroy', row.id), {
      preserveScroll: true,
      onSuccess: () => {

      },
      onError: () => {

      }
    });
  }
}


import { ColumnDef } from '@tanstack/vue-table';


import DataTableDemoColumn from '@/components/DataTableDemoColumn.vue';
import { useFlashToaster } from '@/composables/useFlashToaster';
useFlashToaster();
</script>

<template>

  <Head title="Developer"/>
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
      <div class="flex justify-between items-center">
        <p class="text-muted-foreground">Manage your properties here.</p>
        <Button class="cursor-pointer">
            <Link :href="route('admin.project.create')" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add Project
            </Link>
        </Button>
      </div>
      <DataTable :key="props.project.length" :data="props.project" :columns="columns" filter-key="name" />
    </div>
  </AppLayout>

</template>
