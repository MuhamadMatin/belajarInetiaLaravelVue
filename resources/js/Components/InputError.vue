<!-- resources/js/Components/InputError.vue -->
<script setup>
defineProps({
    message: {
        type: String,
        default: null,
    },
});
</script>

<template>
    <div v-if="message" class="mt-2 text-sm text-red-600">
        {{ message }}
    </div>
</template>
