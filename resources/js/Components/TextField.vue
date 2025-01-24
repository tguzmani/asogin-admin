<template>
    <div>
        <label class="block text-sm font-medium text-white">{{ label }}</label>
        <input
            type="text"
            v-model="model"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
            :placeholder="placeholder ?? label"
        />
        <span v-if="error" class="text-sm text-red-500">
            {{ error }}
        </span>
    </div>
</template>

<script setup lang="ts">
defineProps<{
    error: string;
    placeholder?: string;
    label: string;
}>();

const model = defineModel();
</script>
