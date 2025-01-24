<template>
    <AppLayout title="Membresías">
        <div class="flex flex-col gap-10">
            <h1 class="text-2xl text-white">Membresías</h1>

            <div class="flex flex-row justify-end w-full">
                <div class="search-form w-full max-w-sm min-w-[200px]">
                    <input
                        v-model="search"
                        placeholder="Buscar"
                        class="w-full bg-transparent placeholder:text-slate-400 text-slate-200 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                        @input="performSearch"
                    />
                </div>
            </div>

            <table class="table-fixed text-white w-full">
                <thead class="text-left h-12 bg-slate-700 rounded">
                    <tr class="">
                        <th class="px-6 py-3">Nombre</th>
                        <th class="px-6 py-3">Descripción</th>
                        <th class="px-6 py-3">Precio base (USD)</th>
                    </tr>
                </thead>

                <tbody>
                    <tr
                        class="h-12 hover:bg-slate-700 cursor-pointer odd:bg-slate-900 even:bg-slate-800"
                        v-for="membership in memberships"
                        :key="membership.id"
                    >
                        <td class="px-6 py-3">
                            {{ $filters.capitalize(membership.name) }}
                        </td>
                        <td class="px-6 py-3">
                            {{ membership.description }}
                        </td>
                        <td class="px-6 py-3">
                            {{ membership.base_price }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import Chip from "@/Components/Chip.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import { Membership } from "./Membership";

const props = defineProps<{
    memberships: Membership[];
    filters: {
        search: string;
    };
}>();

const search = ref<string>(props.filters.search || "");

function performSearch() {
    if (search.value.trim() === "") {
        router.get("/memberships", {}, { preserveState: true });
    } else {
        router.get(
            "/memberships",
            { search: search.value },
            { preserveState: true }
        );
    }
}
</script>

<style>
th:first-child {
    border-top-left-radius: 0.5rem;
}

th:last-child {
    border-top-right-radius: 0.5rem;
}

tr:last-child > td:first-child {
    border-bottom-left-radius: 0.5rem;
}

tr:last-child > td:last-child {
    border-bottom-right-radius: 0.5rem;
}
</style>
