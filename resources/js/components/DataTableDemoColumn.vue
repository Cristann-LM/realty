<script setup lang="ts">
import { MoreHorizontal } from 'lucide-vue-next'
import { Button } from '@/components/ui/button'
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuLabel, DropdownMenuTrigger } from '@/components/ui/dropdown-menu'
import { Link } from '@inertiajs/vue3';

defineProps<{
  row: Record<string, any>,
  actions: Array<{
    label: string,
    icon?: any,
    href?: string,
    onClick?: (row: any) => void,
    type?: 'link' | 'button',
    danger?: boolean
  }>
}>()

</script>

<template>
  <DropdownMenu>
    <DropdownMenuTrigger as-child>
      <Button variant="ghost" class="w-8 h-8 p-0 cursor-pointer">
        <span class="sr-only">Open menu</span>
        <MoreHorizontal class="w-4 h-4" />
      </Button>
    </DropdownMenuTrigger>
    <DropdownMenuContent align="end">
      <DropdownMenuLabel class="font-bold">Actions</DropdownMenuLabel>
      <template v-for="action in actions" :key="action.label">
        <DropdownMenuItem
  :class="[action.danger ? 'text-red-600' : '', 'cursor-pointer']"
  @click.stop.prevent="action.onClick && action.onClick(row)"
>
          <template v-if="action.type === 'link' && action.href">
            <Link :href="action.href" target="_blank" rel="noopener noreferrer">
              <span v-if="action.icon" class="mr-2"><component :is="action.icon" /></span>
              {{ action.label }}
            </Link>
          </template>
          <template v-else>
            <span v-if="action.icon" class="mr-2"><component :is="action.icon" /></span>
            {{ action.label }}
          </template>
        </DropdownMenuItem>
      </template>
    </DropdownMenuContent>
  </DropdownMenu>
</template>
