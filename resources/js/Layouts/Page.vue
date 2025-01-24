<template>
    <div class="flex flex-col gap-10">
        <div class="flex flex-row gap-4 items-center">
            <Link :href="goBackLink" v-if="goBackLink">
                <IconButton>
                    <v-icon fill="white" name="fa-arrow-left" />
                </IconButton>
            </Link>
            <h1 class="text-2xl text-white">{{ title }}</h1>
        </div>
        <slot />
    </div>
</template>

<script setup lang="ts">
import IconButton from "@/Components/IconButton.vue";
import { Link } from "@inertiajs/vue3";

defineProps<{
    title: string;
    goBackLink?: string;
}>();
</script>
