<script setup lang="ts">

import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, router, useForm } from '@inertiajs/vue3';
import { h, ref } from 'vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { ArrowUpDown, House } from 'lucide-vue-next';


const props = defineProps({
    amenities: {
        type: Array,
        required: true
    },
    project: {
        type: Object,
        required: true
    }

})
const breadcrumbs: BreadcrumbItem[] = [
      {
        title: 'Project',
        href: route('admin.project.index'),
    },
    {
        title: props.project?.name ?? '',
        href: '/dashboard',
    },

];



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
    }, () => ['Amenities', h(ArrowUpDown, { class: 'ml-2 h-4 w-4' })])
  },
  cell: ({ row }) => {
    const amenities = row.original
    return h('div', { class: 'capitalize' }, amenities ? `${amenities.name}` : '')
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

  id: 'actions',
  enableHiding: false,
 cell: ({ row }) => h(DataTableDemoColumn, {
  row: row.original,
  actions: [

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
    router.delete(route('admin.amenities.destroy', row.id), {
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
import DialogForm from '@/components/DialogForm.vue';


import { useFlashToaster } from '@/composables/useFlashToaster';
useFlashToaster();

const dialogOpen = ref(false)

const form = useForm({
  name: '',
  project_id: props.project.id, // Add this line
});

const create = () => form.post(route('admin.amenities.store'), {
    preserveScroll: true, // keeps scroll position
    onSuccess: () => {
      form.reset()
      dialogOpen.value = false // Close the dialog
    },
    onError: () => {

    },
})
import { Edit, MapIcon, BuildingIcon,} from 'lucide-vue-next';

</script>

<template>

  <Head title="Developer"/>
  <AppLayout :breadcrumbs="breadcrumbs">

    <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
        <div class="flex flex-col gap-4 mb-4 md:flex-row md:gap-8">
      <!-- Project Details Left -->
      <div class="flex-1 flex flex-col gap-2 bg-white rounded-xl shadow p-6 border border-gray-200">
        <div class="flex items-center justify-between mb-2">
          <h1 class="text-3xl font-extrabold text-primary flex items-center gap-2">
            Project Details:
            {{ props.project.name }}
          </h1>
          <Button
            as="a"
            :href="route('admin.project.edit', props.project.id)"
            variant="outline"
            class="ml-4 flex items-center gap-1"
          >
            <Edit class="h-5 w-5 mr-1" />
            Edit
          </Button>
        </div>
        <div class="flex items-center gap-2 text-gray-600">
          <MapIcon class="h-5 w-5 text-gray-400"/>
          <span class="font-medium">Address:</span> {{ props.project.address }} {{ props.project.city }}, {{ props.project.province }}
        </div>
        <div class="flex items-center gap-2 text-gray-600">
          <BuildingIcon class="h-5 w-5 text-gray-400" />
          <span class="font-medium">Developer:</span> {{ props.project.developer.name }}
        </div>
        <div class="flex items-start gap-2 mb-10 text-gray-600">
          <House class="h-5 w-5 text-gray-400 mt-1" />
          <span class="font-medium">Description:</span> <span class="whitespace-pre-line">{{ props.project.description }}</span>
        </div>
        <div class="flex justify-between items-center">
        <h1 class="text-lg font-bold text-muted-foreground">Amenities</h1>
         <DialogForm
            v-model:open="dialogOpen"
            title="Add Amenities"
            description="Add a new Amenities to your project. Click save when you're done."
            :form="form"
            :loading="form.processing"
            :fields="[
                { label: 'Amenities', name: 'name', placeholder: 'Enter amenities' },
                { name: 'project_id', type: 'hidden' }
                ]"
            @submit="create"
            >
            <template #trigger>
                <Button class="cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add Amenities</Button>
            </template>
        </DialogForm>
      </div>
      <DataTable :key="props.amenities.length" :data="props.amenities" :columns="columns" filter-key="name" />
      </div>
      <!-- Google Map Right -->
      <div class="flex-1 flex flex-col gap-2 bg-white rounded-xl shadow p-6 border border-gray-200">
        <h1 class="text-lg font-bold text-muted-foreground">Google Map</h1>
        <p class="text-sm text-gray-500 mb-2">View the project location on the map below.</p>
        <!-- Embed Google Map -->

        <div  v-html="props.project.google_map_link" class="w-full h-80 rounded-lg overflow-hidden shadow-inner flex items-center justify-center text-gray-400 text-lg border-dashed border-2 border-gray-300">
                    </div>
      </div>
    </div>

    </div>
  </AppLayout>



</template>
