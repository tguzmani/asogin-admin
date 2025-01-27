<template>
    <AppLayout title="Miembros">
        <div class="flex flex-col gap-10">
            <h1 class="text-2xl text-white">Miembros</h1>

            <div class="flex flex-row w-full justify-between">
                <Link href="/members/create"
                    ><Button start-icon="fa-plus">Crear miembro</Button></Link
                >

                <div class="search-form min-w-[400px]">
                    <input
                        v-model="search"
                        placeholder="Buscar"
                        class="w-full bg-transparent placeholder:text-slate-400 text-slate-200 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                        @input="performSearch"
                    />
                </div>
            </div>

            <DataGrid :columns="columns" :rows="members" />
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from "@/Layouts/AppLayout.vue";
import Button from "@/Components/Button.vue";
import { ref } from "vue";
import { Link, router } from "@inertiajs/vue3";
import { Member } from "./Member";
import DataGrid from "@/Components/DataGrid.vue";
import StatusRenderValue from "./DataGrid/StatusRenderValue.vue";
import ActionsRenderValue from "./DataGrid/ActionsRenderValue.vue";
import filters from "@/filters";

const props = defineProps<{
    members: Member[];
    filters: {
        search: string;
    };
}>();

const search = ref<string>(props.filters.search || "");

const columns = [
    { field: "id", headerName: "ID" },
    { field: "first_name", headerName: "Nombre" },
    { field: "last_name", headerName: "Apellido" },
    { field: "email", headerName: "Email" },
    { field: "gender", headerName: "Género", renderValue: translateGender },
    {
        field: "latest_membership_name",
        headerName: "Membresía",
        renderValue: filters.capitalize,
    },
    { field: "status", headerName: "Status", renderValue: StatusRenderValue },
    {
        field: "actions",
        headerName: "Acciones",
        renderValue: ActionsRenderValue,
        sortable: false,
    },
];

function translateGender(gender) {
    return gender === "female"
        ? "Femenino"
        : gender === "male"
        ? "Masculino"
        : "Otro";
}

function performSearch() {
    if (search.value.trim() === "") {
        router.get("/members", {}, { preserveState: true });
    } else {
        router.get(
            "/members",
            { search: search.value },
            { preserveState: true }
        );
    }
}
</script>

<style>
th:first-child {
    border-top-left-radius: 0.25rem;
}

th:last-child {
    border-top-right-radius: 0.25rem;
}

tr:last-child > td:first-child {
    border-bottom-left-radius: 0.25rem;
}

tr:last-child > td:last-child {
    border-bottom-right-radius: 0.25rem;
}
</style>
