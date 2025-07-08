<script setup lang="ts">
import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Button } from '@/components/ui/button'
import { ref, watch } from 'vue'

const props = defineProps({
  open: Boolean,
  title: String,
  description: String,
  form: Object,
  loading: Boolean,
  fields: {
    type: Array,
    required: true,
    // Example: [{ label: 'Developer', name: 'name', type: 'text', placeholder: 'Enter name' }]
  }
})
const emit = defineEmits(['update:open', 'submit'])

const localOpen = ref(props.open)
watch(() => props.open, v => localOpen.value = v)
watch(localOpen, v => emit('update:open', v))
</script>

<template>
  <Dialog v-model:open="localOpen">
    <DialogTrigger as-child>
      <slot name="trigger"></slot>
    </DialogTrigger>
    <DialogContent class="sm:max-w-[425px]">
      <DialogHeader>
        <DialogTitle>{{ title }}</DialogTitle>
        <DialogDescription>{{ description }}</DialogDescription>
      </DialogHeader>
      <form @submit.prevent="emit('submit')">
        <div class="grid gap-4 py-4">
          <div
            v-for="field in fields"
            :key="field.name"
            class="grid grid-cols-4 items-center gap-4"
          >
            <Label :for="field.name" class="text-right">{{ field.label }}</Label>
            <template v-if="field.type === 'textarea'">
              <textarea
                :id="field.name"
                :placeholder="field.placeholder"
                class="col-span-3 border rounded px-2 py-1 resize-y min-h-[80px]"
                v-model="form[field.name]"
              ></textarea>
            </template>
            <template v-else>
              <Input
                :id="field.name"
                :type="field.type || 'text'"
                :placeholder="field.placeholder"
                class="col-span-3"
                v-model="form[field.name]"
                @input="field.type === 'number' ? form[field.name] = $event.target.valueAsNumber : null"
              />
            </template>
            <div v-if="form.errors && form.errors[field.name]" class="col-span-4 text-xs text-red-600 mt-1 ml-1">
              {{ form.errors[field.name] }}
            </div>
          </div>
        </div>
        <DialogFooter>
          <Button type="submit" :disabled="loading">
            <slot name="submit">Save</slot>
          </Button>
        </DialogFooter>
      </form>
    </DialogContent>
  </Dialog>
</template>
