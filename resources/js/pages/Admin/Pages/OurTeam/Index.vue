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
        title: 'Our Team',
        href: '/dashboard',
    },

];

const props = defineProps({
    teamMembers: {
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
    }, () => ['Team Member Name', h(ArrowUpDown, { class: 'ml-2 h-4 w-4' })])
  },
  cell: ({ row }) => {
    const teamMember = row.original
    return h('div', { class: 'capitalize' }, teamMember ? `${teamMember.name}` : '')
  },
  filterFn: (row, value) => {
    const teamMember = row.original
    if (!teamMember) return false
    const search = value.toLowerCase()
    return (
      teamMember.name?.toLowerCase().includes(search)
    )
  },
},

  {
  accessorKey: 'job_title',
   header: 'Job Title',
  cell: ({ row }) => {
  const teamMember = row.original
  return h('div', { class: 'capitalize' }, teamMember ? `${teamMember.job_title}` : '')
},
},
{
  accessorKey: 'job_description',
  header: 'Job Description',
  cell: info => h('div', { class: 'multiline-cell' }, info.getValue()),
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
      href: route('admin.our-team.show', row.original.id),
    },
    {
      label: 'Edit',
      type: 'link',
      href: route('admin.our-team.edit', row.original.id),
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
  if (confirm('Are you sure you want to delete this team member?')) {
    router.delete(route('admin.our-team.destroy', row.id), {
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
        <p class="text-muted-foreground"></p>
        <Button class="cursor-pointer">
            <Link :href="route('admin.our-team.create')" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add Team Member
            </Link>
        </Button>
      </div>
      <DataTable :key="props.teamMembers.length" :data="props.teamMembers" :columns="columns" filter-key="job_title" />
    </div>
  </AppLayout>

</template>


