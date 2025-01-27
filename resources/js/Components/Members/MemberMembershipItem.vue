<template>
    <div class="flex flex-col gap-1">
        <p class="text-sm text-gray-600">
            {{ label }}
        </p>
        <p class="text">
            <slot />
        </p>
    </div>
</template>

<script setup lang="ts">
defineProps<{
    label: string;
}>();
</script>
