<template>
    <Chip
        :bgcolor="row.status === 'active' ? 'bg-green-600' : 'bg-red-600'"
        color="text-white"
        >{{ translateStatus(row.status) }}</Chip
    >
</template>

<script setup lang="ts">
import Chip from "@/Components/Chip.vue";

defineProps<{
    row: any;
}>();

function translateStatus(status) {
    return status === "active" ? "Activo" : "Inactivo";
}
</script>
