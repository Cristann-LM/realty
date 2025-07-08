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
        title: 'Inquiry',
        href: '/dashboard',
    },

];

const props = defineProps({
    inquiries: {
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
    }, () => ['Name', h(ArrowUpDown, { class: 'ml-2 h-4 w-4' })])
  },
  cell: ({ row }) => h('div', { class: '' }, row.getValue('name')),
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
    accessorKey: 'email',
    header: ({ column }) => {
      return h(Button, {
        variant: 'ghost',
        onClick: () => column.toggleSorting(column.getIsSorted() === 'asc'),
      }, () => ['Email', h(ArrowUpDown, { class: 'ml-2 h-4 w-4' })])
    },
    cell: ({ row }) => h('div', { class: '' }, row.getValue('email')),
  },
  {
  accessorKey: 'message',
   header: 'Message',
  cell: ({ row }) => h('div', { class: '' }, row.getValue('message')),
},
{
    accessorKey: 'read_at',
    header: 'Status',
    cell: ({ row }) =>
      h('span', {
        class: row.original.read_at ? 'text-green-600 font-semibold' : 'text-red-600 font-semibold',
      }, row.original.read_at ? 'Read' : 'Unread'),
  },
{

  id: 'actions',
  enableHiding: false,
 cell: ({ row }) => h(DataTableDemoColumn, {
  row: row.original,
  actions: [
     {
      label: 'Reply',
      type: 'link',
      href: route('admin.inquiries.edit', row.original.id),
    },
    {
      label: row.original.read_at ? 'Mark as Unread' : 'Mark as Read',
      onClick: () => handleMarkRead(row.original),
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
  if (confirm('Are you sure you want to delete this inquiry?')) {
    router.delete(route('admin.inquiries.destroy', row.id), {
      preserveScroll: true,
      onSuccess: () => {

      },
      onError: () => {

      }
    });
  }
}

function handleMarkRead(row) {
  if (row.read_at) {
    router.patch(route('admin.inquiries.mark-as-read', row.id), { read_at: null }, {
      preserveScroll: true,
      onSuccess: (page) => {
        row.read_at = null;
      }
    });
  } else {
    router.patch(route('admin.inquiries.mark-as-read', row.id), {}, {
      preserveScroll: true,
      onSuccess: (page) => {
        row.read_at = new Date().toISOString(); // or use the value from the response if you handle it
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
        <p class="text-muted-foreground"></p>
      </div>
      <DataTable :key="props.inquiries.length" :data="props.inquiries" :columns="columns" filter-key="name" />
    </div>
  </AppLayout>
</template>
