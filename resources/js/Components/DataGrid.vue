<template>
    <table class="table-fixed text-white w-full">
        <thead class="text-left h-12 bg-slate-700 rounded">
            <tr class="" v-if="columns.length">
                <th v-if="column.length > 1" class="px-6 py-3 rounded-tl-lg">
                    {{ columns[0].headerName }}
                </th>

                <th v-for="column in columns.slice(1, -1)" class="px-6 py-3">
                    {{ column.headerName }}
                </th>

                <th class="px-6 py-3 rounded-tr-lg">{{ columns.at(-1) }}</th>
            </tr>
        </thead>

        <tbody>
            <tr
                class="h-12 hover:bg-slate-700 cursor-pointer odd:bg-slate-900 even:bg-slate-800"
                v-for="row in rows"
                :key="row.id"
            >
                <td class="px-6 py-3">{{ member.first_name }}</td>
                <td class="px-6 py-3">{{ member.last_name }}</td>
                <td class="px-6 py-3">{{ member.email }}</td>
                <td class="px-6 py-3">
                    {{ translateGender(member.gender) }}
                </td>
                <td class="px-6 py-3">
                    <Chip
                        :bgcolor="
                            member.status === 'active'
                                ? 'bg-green-600'
                                : 'bg-red-600'
                        "
                        color="text-white"
                        >{{ translateStatus(member.status) }}</Chip
                    >
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script setup lang="ts">
import { DataGridProps } from "@/types/DataGridInterface";

defineProps<DataGridProps>();
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
