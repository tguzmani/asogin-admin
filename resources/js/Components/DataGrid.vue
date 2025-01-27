<template>
    <div
        class="w-full"
        :style="{
            overflowY: 'auto',
        }"
    >
        <!-- Data Table -->
        <table class="table-auto text-white w-full">
            <thead class="text-left h-12 bg-slate-700 rounded">
                <tr v-if="columns.length">
                    <th
                        v-for="column in columns"
                        :key="column.field"
                        class="relative px-6 py-3 cursor-pointer"
                        @click="toggleSort(column)"
                    >
                        <span class="mr-2">{{ column.headerName }}</span>
                        <v-icon
                            v-if="column.sortable !== false"
                            name="fa-sort"
                            class="absolute top-4 text-slate-500"
                        />
                        <v-icon
                            v-if="
                                sortState.field === column.field &&
                                sortState.direction !== 'unsort'
                            "
                            :name="getSortIcon(column)"
                            class="absolute top-4 text-slate-300"
                        />
                    </th>
                </tr>
            </thead>
            <tbody class="bg-slate-800">
                <tr
                    class="h-12 hover:bg-slate-700 cursor-pointer odd:bg-slate-900 even:bg-slate-800"
                    v-for="row in rows"
                    :key="row.id"
                >
                    <td
                        v-for="column in columns"
                        :key="column.field"
                        class="px-6 py-3"
                    >
                        <span v-if="typeof column.renderValue === 'function'">
                            {{ column.renderValue(row[column.field]) }}
                        </span>
                        <component
                            v-else-if="column.renderValue"
                            :is="column.renderValue"
                            :row="row"
                        />
                        <span v-else>{{ row[column.field] }}</span>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Pagination Controls -->
        <div
            v-if="pagination"
            class="flex items-center justify-end text-slate-300 mt-4"
        >
            <div class="flex items-center gap-2 mr-4">
                <span>Rows per page:</span>
                <select
                    v-model="perPage"
                    class="bg-slate-700 text-white border border-slate-600 rounded px-3 py-1 w-20"
                    @change="updatePerPage"
                >
                    <option :value="5">5</option>
                    <option :value="10">10</option>
                    <option :value="20">20</option>
                    <option :value="100">100</option>
                </select>
            </div>
            <div class="mr-4">
                {{ pageStart }}–{{ pageEnd }} of {{ totalRows }}
            </div>
            <div class="flex items-center gap-2">
                <button
                    :disabled="currentPage === 1"
                    class="px-2 py-1 bg-slate-700 text-white rounded disabled:opacity-50"
                    @click="changePage(currentPage - 1)"
                >
                    <v-icon name="fa-angle-left" fill="white" />
                </button>
                <button
                    :disabled="currentPage === totalPages"
                    class="px-2 py-1 bg-slate-700 text-white rounded disabled:opacity-50"
                    @click="changePage(currentPage + 1)"
                >
                    <v-icon name="fa-angle-right" fill="white" />
                </button>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, computed, defineProps, defineEmits } from "vue";

interface DataGridProps {
    columns: {
        field: string;
        headerName: string;
        renderValue?: ((row: any) => string | Node) | any;
        sortable?: boolean;
    }[];
    rows: any[];
    pagination: boolean;
    totalRows: number;
    minHeight?: number; // Optional minHeight prop in pixels
}

const props = defineProps<DataGridProps>();
const emit = defineEmits(["update:page", "update:perPage", "update:sort"]);

const currentPage = ref(1);
const perPage = ref(10);

const totalPages = computed(() => Math.ceil(props.totalRows / perPage.value));
const pageStart = computed(() => (currentPage.value - 1) * perPage.value + 1);
const pageEnd = computed(() =>
    Math.min(currentPage.value * perPage.value, props.totalRows)
);

function changePage(page) {
    if (page < 1 || page > totalPages.value) return;
    currentPage.value = page;
    emit("update:page", { page, perPage: perPage.value });
}

function updatePerPage() {
    currentPage.value = 1; // Reset to first page when changing perPage
    emit("update:perPage", { page: currentPage.value, perPage: perPage.value });
}

function toggleSort(column) {
    if (column.sortable === false) return;

    if (sortState.value.field === column.field) {
        sortState.value.direction =
            sortState.value.direction === "asc"
                ? "desc"
                : sortState.value.direction === "desc"
                ? "unsort"
                : "asc";
    } else {
        sortState.value.field = column.field;
        sortState.value.direction = "asc";
    }

    emit("update:sort", {
        field: sortState.value.field,
        direction: sortState.value.direction,
        page: currentPage.value,
        perPage: perPage.value,
    });
}

const sortState = ref({ field: "", direction: "unsort" });

function getSortIcon(column) {
    if (sortState.value.field === column.field) {
        if (sortState.value.direction === "asc") return "fa-sort-up";
        if (sortState.value.direction === "desc") return "fa-sort-down";
    }
    return "fa-sort";
}
</script>
