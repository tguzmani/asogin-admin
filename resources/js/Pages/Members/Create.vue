<template>
    <AppLayout title="Agregar miembro">
        <Page title="Agregar miembro" goBackLink="/members">
            <div class="w-full bg-slate-800 p-6 rounded shadow-md">
                <form @submit.prevent="submitForm" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <TextField
                            v-model="form.first_name"
                            label="Primer Nombre"
                            :error="form.errors.first_name"
                        />
                        <TextField
                            v-model="form.last_name"
                            label="Apellido"
                            :error="form.errors.last_name"
                        />
                        <TextField
                            v-model="form.email"
                            label="Correo electrónico"
                            :error="form.errors.email"
                        />

                        <TextField
                            v-model="form.phone"
                            label="Teléfono"
                            :error="form.errors.phone"
                        />

                        <div>
                            <label class="block text-sm font-medium text-white"
                                >Fecha de nacimiento</label
                            >
                            <input
                                type="date"
                                v-model="form.date_of_birth"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            />
                            <span
                                v-if="form.errors.date_of_birth"
                                class="text-sm text-red-500"
                            >
                                {{ form.errors.date_of_birth }}
                            </span>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-white"
                                >Género</label
                            >
                            <select
                                v-model="form.gender"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            >
                                <option value="">Seleccione el género</option>
                                <option value="male">Masculino</option>
                                <option value="female">Femenino</option>
                                <option value="other">Otro</option>
                            </select>
                            <span
                                v-if="form.errors.gender"
                                class="text-sm text-red-500"
                            >
                                {{ form.errors.gender }}
                            </span>
                        </div>
                    </div>

                    <div class="flex justify-end pt-2">
                        <button
                            type="submit"
                            class="px-6 py-2 w-44 bg-slate-600 text-white font-medium rounded-md shadow-sm hover:bg-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        >
                            Crear
                        </button>
                    </div>
                </form>
            </div>
        </Page>
    </AppLayout>
</template>

<script setup>
import TextField from "@/Components/TextField.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Page from "@/Layouts/Page.vue";
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    first_name: "",
    last_name: "",
    email: "",
    phone: "",
    date_of_birth: null,
    gender: null,
});

const submitForm = () => {
    form.post(route("members.store"), {
        onSuccess: () => form.reset(),
    });
};
</script>
