<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, router} from '@inertiajs/vue3';
import { h } from 'vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { ArrowUpDown } from 'lucide-vue-next';
import DataTableDemoColumn from '@/components/DataTableDemoColumn.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Properties',
        href: '/dashboard',
    },
];




const props = defineProps({
    properties: {
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
  accessorKey: 'project.name',
  header: ({ column }) => {
    return h(Button, {
      variant: 'ghost',
      onClick: () => column.toggleSorting(column.getIsSorted() === 'asc'),
    }, () => ['Project Name', h(ArrowUpDown, { class: 'ml-2 h-4 w-4' })])
  },
  cell: ({ row }) => {
    const project = row.original.project
    return h('div', { class: 'capitalize' }, project ? `${project.name} (${project.city})` : '')
  },
  filterFn: (row, id, value) => {
    const project = row.original.project
    if (!project) return false
    const search = value.toLowerCase()
    return (
      project.name?.toLowerCase().includes(search) ||
      project.city?.toLowerCase().includes(search)
    )
  },
},
  {
    accessorKey: 'name',
    header: ({ column }) => {
      return h(Button, {
        variant: 'ghost',
        onClick: () => column.toggleSorting(column.getIsSorted() === 'asc'),
      }, () => ['Unit Name', h(ArrowUpDown, { class: 'ml-2 h-4 w-4' })])
    },
    cell: ({ row }) => h('div', { class: 'lowercase' }, row.getValue('name')),
  },
  {
    accessorKey: 'price',
    header: () => h('div', { class: 'text-right' }, 'Price'),
    cell: ({ row }) => {
      const amount = Number.parseFloat(row.getValue('price'))

      // Format the amount as a dollar amount
      const formatted = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'PHP',
      }).format(amount)

      return h('div', { class: 'text-right font-medium' }, formatted)
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
      href: route('admin.property-units.show', row.original.id),
    },
    {
      label: 'Edit',
      type: 'link',
      href: route('admin.property-units.edit', row.original.id),
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
  if (confirm('Are you sure you want to delete this project unit?')) {
    router.delete(route('admin.property-units.destroy', row.id), {
      preserveScroll: true,
      onSuccess: () => {
        // Reload the page data after delete
        router.reload({ only: ['properties'] });
      },
      onError: () => {
        // Optionally handle error
      }
    });
  }
}

import { ColumnDef } from '@tanstack/vue-table';
import { useFlashToaster } from '@/composables/useFlashToaster';
useFlashToaster();

</script>

<template>
    <Head title="Properties"/>

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="flex justify-between items-center">
                <p class="text-muted-foreground">Manage your properties here.</p>
                <Button class="cursor-pointer">
                    <Link :href="route('admin.property-units.create')" class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add Unit
                    </Link>
                </Button>
            </div>


                        <DataTable :key="props.properties.length" :data="props.properties" :columns="columns" filter-key="project_name" />
        </div>
    </AppLayout>

</template>
