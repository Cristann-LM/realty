<template>
    <div>{{ formatted }}</div>
</template>
<script lang="ts" setup>
    const props = defineProps({
        amount: {
            type: Object,
            required: true
        },

    })
    const amount = Number.parseFloat(props.amount)

      // Format the amount as a dollar amount
      const formatted = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'PHP',
}).format(amount)

</script>
