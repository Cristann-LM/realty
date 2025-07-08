<script setup lang="ts">

import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Button } from '@/components/ui/button';
import { useFlashToaster } from '@/composables/useFlashToaster';
useFlashToaster();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
    {
        title: 'Inquiries',
        href: '/admin/inquiries',
    },
    {
        title: 'Reply',
        href: '#',
    },
];

const props = defineProps({
    inquiry: {
        type: Object,
        required: true
    }
});

const reply = ref(props.inquiry.reply ?? '');
const submitting = ref(false);
const hasReply = ref(!!props.inquiry.reply);

const handleReply = () => {
    submitting.value = true;
    router.put(
        route('admin.inquiries.update', props.inquiry.id),
        { reply: reply.value },
        {
            onFinish: () => (submitting.value = false),
        }
    );
};
</script>

<template>
  <Head title="Reply to Inquiry"/>
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex flex-col gap-4 rounded-xl p-4 w-2/3 mx-auto bg-white shadow border border-gray-200 mt-8">
      <h1 class="text-2xl font-bold mb-2">Reply to Inquiry</h1>
      <div class="mb-4">
        <div class="mb-2">
          <span class="font-semibold">From:</span> {{ props.inquiry.name }} ({{ props.inquiry.email }})
        </div>
        <div class="mb-2">
          <span class="font-semibold">Message:</span>
          <div class="bg-gray-100 rounded p-3 mt-1">{{ props.inquiry.message }}</div>
        </div>
      </div>
      <form @submit.prevent="handleReply" class="space-y-4">
        <div>
          <label for="reply" class="block text-sm font-medium text-gray-700">Your Reply</label>
          <textarea
            id="reply"
            v-model="reply"
            rows="5"
            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-3"
            placeholder="Type your reply here..."
            required
            :disabled="hasReply"
          ></textarea>
        </div>
        <div class="flex justify-end">
          <Button
            type="submit"
            :disabled="submitting || hasReply"
            class="cursor-pointer"
          >
            {{ submitting ? 'Sending...' : hasReply ? 'Reply Sent' : 'Send Reply' }}
          </Button>
        </div>
      </form>
    </div>
  </AppLayout>
</template>
