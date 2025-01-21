<template>
    <AppLayout title="Miembros">
        <div class="flex flex-col gap-10">
            <h1 class="text-2xl text-white">Miembros</h1>

            <table class="table-fixed text-white w-full">
                <thead class="text-left h-12 bg-slate-700 rounded">
                    <tr class="">
                        <th class="px-6 py-3 rounded-tl-lg">Nombre</th>
                        <th class="px-6 py-3">Apellido</th>
                        <th class="px-6 py-3">Email</th>
                        <th class="px-6 py-3">Género</th>
                        <th class="px-6 py-3 rounded-tr-lg">Status</th>
                    </tr>
                </thead>

                <tbody>
                    <tr
                        class="h-12 hover:bg-slate-700 cursor-pointer odd:bg-slate-900 even:bg-slate-800"
                        v-for="member in members"
                        :key="member.id"
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
        </div>
    </AppLayout>
</template>

<script>
import Chip from "@/Components/Chip.vue";
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
    components: {
        AppLayout,
        Chip,
    },
    methods: {
        translateStatus(status) {
            return status === "active" ? "Activo" : "Inactivo";
        },
        translateGender(gender) {
            return gender === "female"
                ? "Femenino"
                : gender === "male"
                ? "Masculino"
                : "Otro";
        },
    },
    props: {
        members: Array,
    },
};
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
