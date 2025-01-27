<template>
    <table class="table-auto text-white w-full">
        <thead class="text-left h-12 bg-slate-700 rounded">
            <tr v-if="columns.length">
                <th
                    v-for="column in columns"
                    :key="column.field"
                    class="relative px-6 py-3"
                    @click="toggleSort(column)"
                >
                    <span class="mr-2">
                        {{ column.headerName }}
                    </span>
                    <!-- Sorting icon -->
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

        <tbody>
            <tr
                class="h-12 hover:bg-slate-700 cursor-pointer odd:bg-slate-900 even:bg-slate-800"
                v-for="row in sortedRows"
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
</template>

<script setup lang="ts">
import { ref, computed } from "vue";

export interface DataGridColumn {
    field: string;
    headerName: string;
    renderValue?: ((row: any) => string | Node) | any;
    sortable?: boolean; // Indicates if the column is sortable
}

export interface DataGridProps {
    columns: DataGridColumn[];
    rows: any[];
}

const props = defineProps<DataGridProps>();

// State to track sorting
const sortState = ref({
    field: "", // Active sorting column
    direction: "unsort", // Can be 'asc', 'desc', or 'unsort'
});

// Computed property to handle sorted rows
const sortedRows = computed(() => {
    const { field, direction } = sortState.value;

    // Return rows unsorted if no sorting is applied
    if (!field || direction === "unsort") {
        return props.rows;
    }

    const isNumeric = (value: any) => !isNaN(value);

    return [...props.rows].sort((a, b) => {
        const valueA = a[field];
        const valueB = b[field];

        // Handle sorting for numbers
        if (isNumeric(valueA) && isNumeric(valueB)) {
            return direction === "asc" ? valueA - valueB : valueB - valueA;
        }

        // Handle sorting for text (case-insensitive)
        const strA = String(valueA).toLowerCase();
        const strB = String(valueB).toLowerCase();

        if (strA < strB) return direction === "asc" ? -1 : 1;
        if (strA > strB) return direction === "asc" ? 1 : -1;
        return 0;
    });
});

// Method to toggle sorting state
function toggleSort(column: DataGridColumn) {
    if (column.sortable === false) return;

    if (sortState.value.field === column.field) {
        // Cycle between 'asc', 'desc', and 'unsort'
        sortState.value.direction =
            sortState.value.direction === "asc"
                ? "desc"
                : sortState.value.direction === "desc"
                ? "unsort"
                : "asc";
    } else {
        // Set sorting to 'asc' for a new column
        sortState.value.field = column.field;
        sortState.value.direction = "asc";
    }
}

// Method to get the correct sort icon for the column
function getSortIcon(column: DataGridColumn) {
    if (sortState.value.field === column.field) {
        if (sortState.value.direction === "asc") return "fa-sort-up";
        if (sortState.value.direction === "desc") return "fa-sort-down";
    }
    return "fa-sort";
}
</script>

<style>
/* Ensure icons are properly aligned */
th .ml-2 {
    margin-left: auto;
}
</style>
