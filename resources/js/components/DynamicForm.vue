<script setup lang="ts">
import { useForm as useInertiaForm } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import {
  FormControl,
  FormDescription,
  FormField,
  FormItem,
  FormLabel,
} from '@/components/ui/form';
import { Input } from '@/components/ui/input';
import { Textarea } from '@/components/ui/textarea';
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/components/ui/select';
import { toast } from 'vue-sonner';
import { reactive } from 'vue';


interface FieldConfig {
  name: string;
  label: string;
  type: 'text' | 'textarea' | 'number' | 'email' | 'password' | 'select' | 'file';
  placeholder?: string;
  description?: string;
  options?: { value: string | number; label: string }[];
}

const props = defineProps<{
  schema: any; // Zod schema, not used without vee-validate
  initialData: Record<string, any>;
  fields: FieldConfig[];
  submitRoute: string;
  submitMethod: 'post' | 'put' | 'patch';
  submitButtonText: string;
  currentImage: string | null;
}>();


const inertiaForm = useInertiaForm(props.initialData);

const filePreviews = reactive<Record<string, string>>({});

function handleFileChange(event: Event, fieldName: string) {
  const files = (event.target as HTMLInputElement).files;
  if (files && files[0]) {
    filePreviews[fieldName] = URL.createObjectURL(files[0]);
    inertiaForm[fieldName] = files[0];
  } else {
    delete filePreviews[fieldName];
    inertiaForm[fieldName] = null;
  }
}

const onSubmit = async () => {
  console.log('Submitting', inertiaForm)
  const hasFile = props.fields.some(
    (field) => field.type === 'file' && inertiaForm[field.name] instanceof File
  );

  // Add method spoofing for PUT/PATCH
  if (props.submitMethod === 'put') {
    inertiaForm.put(props.submitRoute, {
      preserveScroll: true,
      forceFormData: hasFile,
      onSuccess: (page: any) => {
        if (page.props.flash && (page.props.flash as Record<string, any>).success) {
          toast('Success', {
            description: (page.props.flash as Record<string, any>).success || '',
          });
        }
      },
      onError: (errors: Record<string, string>) => {
        Object.keys(errors).forEach((key) => {
          inertiaForm.setError(key, errors[key]);
        });
      },
    });
  } else if (props.submitMethod === 'patch') {
    inertiaForm.patch(props.submitRoute, {
      preserveScroll: true,
      forceFormData: hasFile,
      onSuccess: (page: any) => {
        if (page.props.flash && (page.props.flash as Record<string, any>).success) {
          toast('Success', {
            description: (page.props.flash as Record<string, any>).success || '',
          });
        }
      },
      onError: (errors: Record<string, string>) => {
        Object.keys(errors).forEach((key) => {
          inertiaForm.setError(key, errors[key]);
        });
      },
    });
  } else {
     if (props.submitMethod !== 'post') {
    inertiaForm._method = props.submitMethod;
  }

    inertiaForm.post(props.submitRoute, {
      preserveScroll: true,
      forceFormData: hasFile,
      onSuccess: (page: any) => {
        if (page.props.flash && (page.props.flash as Record<string, any>).success) {
          toast('Success', {
            description: (page.props.flash as Record<string, any>).success || '',
          });
        }
      },
      onError: (errors: Record<string, string>) => {
        Object.keys(errors).forEach((key) => {
          inertiaForm.setError(key, errors[key]);
        });
      },
    });
  }
};
</script>

<template>
  <form class="w-full space-y-6" @submit.prevent="onSubmit">
    <template v-for="(row, idx) in props.fields" :key="idx">
      <div v-if="Array.isArray(row)" class="flex gap-3 w-full">
        <FormField
          v-for="field in row"
          :key="field.name"
          :name="field.name"
          class="flex-1 w-full "
        >
          <FormItem class="w-full">
            <FormLabel>{{ field.label }}</FormLabel>
            <FormControl>
              <template v-if="field.type === 'textarea'">
                <Textarea
                  :placeholder="field.placeholder"
                  v-model="inertiaForm[field.name]"
                />
              </template>
              <template v-else-if="field.type === 'select'">
                <Select v-model="inertiaForm[field.name]" class="w-full">
                  <SelectTrigger class="w-full">
                    <SelectValue :placeholder="field.placeholder" />
                  </SelectTrigger>
                  <SelectContent class="w-full">
                    <SelectItem v-for="option in field.options" :key="option.value" :value="option.value">
                      {{ option.label }}
                    </SelectItem>
                  </SelectContent>
                </Select>
              </template>
              <template v-else-if="field.type === 'file'">
                <Input
                  type="file"
                  :placeholder="field.placeholder"
                  @change="(e: Event) => handleFileChange(e, field.name)"
                />
                <!-- Preview new file if selected -->
                <div v-if="filePreviews[field.name]" class="mt-2">
                  <img :src="filePreviews[field.name]" alt="Preview" class="max-h-32 rounded border" />
                </div>
                <!-- Preview current image if exists and no new file selected -->
                <div v-else-if="props.currentImage" class="mt-2">
                <img :src="props.currentImage.startsWith('http') ? props.currentImage : '/storage/' + props.currentImage" alt="Current Image" class="max-h-32 rounded border" />
                </div>
              </template>
              <template v-else>
                <Input
                  :type="field.type"
                  :placeholder="field.placeholder"
                  v-model="inertiaForm[field.name]"
                />
              </template>
            </FormControl>
            <FormDescription v-if="field.description">
              {{ field.description }}
            </FormDescription>
            <div v-if="inertiaForm.errors[field.name]" class="input-error">
              {{ inertiaForm.errors[field.name] }}
            </div>
          </FormItem>
        </FormField>
      </div>
      <FormField
        v-else
        :name="row.name"
        :key="row.name"
      >
        <FormItem>
          <FormLabel>{{ row.label }}</FormLabel>
          <FormControl>
            <template v-if="row.type === 'textarea'">
              <Textarea
                :placeholder="row.placeholder"
                v-model="inertiaForm[row.name]"
              />
            </template>
            <template v-else-if="row.type === 'select'">
              <Select v-model="inertiaForm[row.name]" class="w-full">
                <SelectTrigger class="w-full">
                  <SelectValue :placeholder="row.placeholder" />
                </SelectTrigger>
                <SelectContent class="w-full">
                  <SelectItem v-for="option in row.options" :key="option.value" :value="option.value">
                    {{ option.label }}
                  </SelectItem>
                </SelectContent>
              </Select>
            </template>
            <template v-else-if="row.type === 'file'">
              <Input
                type="file"
                :placeholder="row.placeholder"
                @change="(e: Event) => handleFileChange(e, row.name)"
              />
              <!-- Preview new file if selected -->
                <div v-if="filePreviews[row.name]" class="mt-2">
                  <img :src="filePreviews[row.name]" alt="Preview" class="max-h-32 rounded border" />
                </div>
                <!-- Preview current image if exists and no new file selected -->
                <div v-else-if="props.currentImage" class="mt-2">
                <img :src="props.currentImage.startsWith('http') ? props.currentImage : '/storage/' + props.currentImage" alt="Current Image" class="max-h-32 rounded border" />
                </div>
            </template>
            <template v-else>
              <Input
                :type="row.type"
                :placeholder="row.placeholder"
                v-model="inertiaForm[row.name]"
              />
            </template>
          </FormControl>
          <FormDescription v-if="row.description">
            {{ row.description }}
          </FormDescription>
          <div v-if="inertiaForm.errors[row.name]" class="input-error">
            {{ inertiaForm.errors[row.name] }}
          </div>
        </FormItem>
      </FormField>
    </template>
    <Button class="cursor-pointer" type="submit" :disabled="inertiaForm.processing">
      {{ props.submitButtonText }}
    </Button>
  </form>
</template>
