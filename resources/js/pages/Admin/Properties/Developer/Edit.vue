<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import {   } from '@inertiajs/vue3';
import { toTypedSchema } from '@vee-validate/zod'
import { useForm } from 'vee-validate'
import { useForm as useInertiaForm } from '@inertiajs/vue3'

import * as z from 'zod'

import { Button } from '@/components/ui/button'
import {
  FormControl,
  FormDescription,
  FormField,
  FormItem,
  FormLabel,
  FormMessage,
} from '@/components/ui/form'
import { Input } from '@/components/ui/input'
import { toast } from 'vue-sonner';




const formSchema = toTypedSchema(z.object({
  username: z.string().max(50),
}))

const { isFieldDirty } = useForm({
  validationSchema: formSchema,
})



const props = defineProps({
    developer: {
        type: Object,
        required: true
    }

})




const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Developer',
        href: route('admin.developer.index'),
    },
    {
        title: props.developer.name,
        href: '/dashboard',
    },
];






const form = useInertiaForm({
  name: props.developer.name,
})


const update = () => form.put(route('admin.developer.update', {developer: props.developer.id}), {
  onSuccess: () => {
    toast('Success',{
      description: 'Developer updated successfully!',
    });
  }
})



</script>

<template>
    <Head title="Edit Developer"/>

     <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <form class="w-1/3 space-y-6" @submit.prevent="update">
                <FormField  name="name" :validate-on-blur="!isFieldDirty">
                <FormItem>
                    <FormLabel>Developer Name</FormLabel>
                    <FormControl>
                    <Input type="text" placeholder="Developer Name" v-model="form.name"  />
                    </FormControl>
                    <FormDescription>

                    </FormDescription>
                    <FormMessage />
                </FormItem>
                </FormField>
                <Button class="cursor-pointer" type="submit">
                Update
                </Button>
            </form>
        </div>
    </AppLayout>

</template>
