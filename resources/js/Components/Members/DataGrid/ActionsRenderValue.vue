<template>
    <div class="flex flex-row items-center gap-4">
        <Link :href="`/members/${row.id}`">
            <IconButton>
                <v-icon name="fa-eye" fill="white" />
            </IconButton>
        </Link>

        <!-- <Link :href="`/members/${member.id}/edit`"> -->
        <Link href="#">
            <IconButton>
                <v-icon name="fa-edit" fill="white" />
            </IconButton>
        </Link>
    </div>
</template>

<script setup lang="ts">
import IconButton from "@/Components/IconButton.vue";
import { Link } from "@inertiajs/vue3";

defineProps<{
    row: any;
}>();
</script>
