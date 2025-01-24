<template>
    <button
        class="transition-all px-4 py-2 hover:bg-slate-600 bg-slate-700 active:bg-slate-800 rounded text-white"
    >
        <span v-if="startIcon" class="mr-2">
            <v-icon :name="startIcon"></v-icon>
        </span>
        <slot />
    </button>
</template>

<script setup lang="ts">
defineProps<{
    startIcon?: string;
}>();
</script>
