<template>
    <AppLayout title="Miembros">
        <div class="flex flex-col gap-10">
            <h1 class="text-2xl text-white">Miembros</h1>

            <div class="flex flex-row w-full justify-between">
                <Link href="/members/create">
                    <Button start-icon="fa-plus">Crear miembro</Button>
                </Link>

                <div class="search-form min-w-[400px]">
                    <input
                        v-model="search"
                        placeholder="Buscar"
                        class="w-full bg-transparent placeholder:text-slate-400 text-slate-200 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                        @input="performSearch"
                    />
                </div>
            </div>

            <DataGrid
                :columns="columns"
                :rows="members.data"
                :pagination="true"
                :totalRows="members.total"
                :minHeight="500"
                @update:page="fetchPage"
                @update:perPage="fetchPerPage"
                @update:sort="fetchSorted"
            />
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from "@/Layouts/AppLayout.vue";
import Button from "@/Components/Button.vue";
import DataGrid from "@/Components/DataGrid.vue";
import { ref } from "vue";
import { Link, router } from "@inertiajs/vue3";
import StatusRenderValue from "./DataGrid/StatusRenderValue.vue";
import ActionsRenderValue from "./DataGrid/ActionsRenderValue.vue";

const props = defineProps<{
    members: {
        data: any[];
        total: number;
    };
    filters: {
        search: string;
        sortField: string;
        sortDirection: string;
    };
}>();

const search = ref(props.filters.search || "");
const sortField = ref(props.filters.sortField || "id");
const sortDirection = ref(props.filters.sortDirection || "asc");

const columns = [
    { field: "id", headerName: "ID" },
    { field: "first_name", headerName: "Nombre" },
    { field: "last_name", headerName: "Apellido" },
    { field: "email", headerName: "Email" },
    {
        field: "gender",
        headerName: "Género",
        renderValue: renderGender,
    },
    { field: "status", headerName: "Estado", renderValue: StatusRenderValue },
    {
        field: "actions",
        headerName: "Acciones",
        renderValue: ActionsRenderValue,
    },
];

function renderGender(value) {
    return value === "female"
        ? "Femenino"
        : value === "male"
        ? "Masculino"
        : "Otro";
}

function performSearch() {
    router.get(
        "/members",
        {
            search: search.value,
            sortField: sortField.value,
            sortDirection: sortDirection.value,
        },
        { preserveState: true }
    );
}

function fetchPage({ page, perPage }) {
    router.get("/members", { page, perPage }, { preserveState: true });
}

function fetchPerPage({ perPage }) {
    router.get(
        "/members",
        {
            perPage,
            sortField: sortField.value,
            sortDirection: sortDirection.value,
            search: search.value,
        },
        { preserveState: true }
    );
}

function fetchSorted({ field, direction, page, perPage }) {
    router.get(
        "/members",
        { sortField: field, sortDirection: direction, page, perPage },
        { preserveState: true }
    );
}
</script>
