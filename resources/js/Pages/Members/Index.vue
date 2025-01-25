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

            <table class="table-auto text-white w-full">
                <thead class="text-left h-12 bg-slate-700 rounded">
                    <tr class="">
                        <th class="px-6 py-3">ID</th>
                        <th class="px-6 py-3">Nombre</th>
                        <th class="px-6 py-3">Apellido</th>
                        <th class="px-6 py-3">Email</th>
                        <th class="px-6 py-3">Género</th>
                        <th class="px-6 py-3">Membresía</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <tr
                        class="h-12 cursor-pointer odd:bg-slate-900 even:bg-slate-800"
                        v-for="member in members"
                        :key="member.id"
                    >
                        <td class="px-6 py-3">{{ member.id }}</td>
                        <td class="px-6 py-3">{{ member.first_name }}</td>
                        <td class="px-6 py-3">{{ member.last_name }}</td>
                        <td class="px-6 py-3">{{ member.email }}</td>
                        <td class="px-6 py-3">
                            {{ translateGender(member.gender) }}
                        </td>
                        <td class="px-6 py-3">
                            {{
                                member.latest_membership_name
                                    ? $filters.capitalize(
                                          member.latest_membership_name
                                      )
                                    : "--"
                            }}
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
                        <td>
                            <div class="flex flex-row items-center gap-4">
                                <Link :href="`/members/${member.id}`">
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
import Button from "@/Components/Button.vue";
import { ref } from "vue";
import { Link, router } from "@inertiajs/vue3";
import { Member } from "./Member";
import IconButton from "@/Components/IconButton.vue";

const props = defineProps<{
    members: Member[];
    filters: {
        search: string;
    };
}>();

const search = ref<string>(props.filters.search || "");

function translateStatus(status) {
    return status === "active" ? "Activo" : "Inactivo";
}

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
