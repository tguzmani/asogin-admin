<template>
    <AppLayout :title="title">
        <div class="flex flex-col gap-10">
            <h1 class="text-2xl text-white">{{ title }}</h1>

            <div class="flex flex-row w-full justify-between">
                <Link :href="`${route}/create`">
                    <Button start-icon="fa-plus">{{ createText }}</Button>
                </Link>

                <SearchBar v-model="search" @search="performSearch" />
            </div>

            <DataGrid
                :columns="columns"
                :rows="entities.data"
                :pagination="true"
                :totalRows="entities.total"
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
import { Link } from "@inertiajs/vue3";
import filters from "@/filters";
import DataGrid from "@/Components/DataGrid/DataGrid.vue";
import MemberStatusRenderValue from "@/Components/Members/DataGrid/MemberStatusRenderValue.vue";
import ActionsRenderValue from "@/Components/Members/DataGrid/ActionsRenderValue.vue";
import { useDataGrid } from "@/Components/DataGrid/useDataGrid";
import SearchBar from "@/Components/SearchBar.vue";
import { DataGridColumn } from "@/Types/DataGridInterface";

defineProps<{
    entities: {
        data: any[];
        total: number;
    };
    columns: DataGridColumn[];
    title: string;
    route: string;
    createText: string;
}>();

const { search, performSearch, fetchPage, fetchPerPage, fetchSorted } =
    useDataGrid("/members");
</script>
