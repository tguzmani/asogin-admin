<template>
    <div class="search-form min-w-[400px]">
        <input
            v-model="props.modelValue"
            placeholder="Buscar"
            class="w-full bg-transparent placeholder:text-slate-400 text-slate-200 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
            @input="emitSearch"
        />
    </div>
</template>

<script setup lang="ts">
import { defineProps, defineEmits } from "vue";

const props = defineProps<{
    modelValue: string;
}>();

const emit = defineEmits(["update:modelValue", "search"]);

function emitSearch(event: Event) {
    emit("update:modelValue", (event.target as HTMLInputElement).value);
    emit("search");
}
</script>
