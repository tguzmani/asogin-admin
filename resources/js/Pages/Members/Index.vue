<template>
    <IndexPage
        createText="Crear miembro"
        title="Miembros"
        route="/members"
        :columns="columns"
        :entities="members"
        :filters="props.filters"
    />
</template>

<script setup lang="ts">
import filters from "@/filters";
import MemberStatusRenderValue from "@/Components/Members/DataGrid/MemberStatusRenderValue.vue";
import ActionsRenderValue from "@/Components/Members/DataGrid/ActionsRenderValue.vue";
import IndexPage from "../Layout/IndexPage.vue";

const props = defineProps<{
    members: {
        data: any[];
        total: number;
    };
    filters: {
        search: string;
        sortField: string;
        sortDirection: "asc" | "desc";
    };
}>();

console.log(props.filters);

function renderGender(gender) {
    return gender === "female"
        ? "Femenino"
        : gender === "male"
        ? "Masculino"
        : "Otro";
}

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
    {
        field: "latest_membership_name",
        headerName: "Membresía",
        renderValue: filters.capitalize,
    },
    {
        field: "status",
        headerName: "Estado",
        renderValue: MemberStatusRenderValue,
    },
    {
        field: "actions",
        headerName: "Acciones",
        renderValue: ActionsRenderValue,
        sortable: false,
    },
];
</script>
