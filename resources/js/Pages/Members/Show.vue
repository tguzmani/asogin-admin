<template>
    <AppLayout title="Member Details">
        <Page title="Member Details" goBackLink="/members">
            <div class="py-8">
                <div
                    class="bg-slate-700 text-white p-6 rounded-md shadow-md items-center flex gap-4"
                >
                    <v-icon name="fa-user" :scale="2" fill="white" />

                    <div>
                        <h1 class="text-2xl font-bold">
                            {{ member.first_name }} {{ member.last_name }}
                        </h1>
                        <p class="text-lg text-gray-300">{{ member.email }}</p>
                        <p class="text-lg text-gray-300">{{ member.phone }}</p>
                    </div>
                </div>

                <div class="mt-8">
                    <div class="bg-white p-6 rounded-md shadow-md">
                        <h2 class="text-xl font-bold mb-4">
                            Información de membresía
                        </h2>

                        <div class="flex flex-col gap-3">
                            <div class="grid grid-cols-3 gap-4">
                                <MemberMembershipItem label="Nombre del plan">
                                    {{
                                        $filters.capitalize(
                                            member.membership.name
                                        )
                                    }}
                                </MemberMembershipItem>

                                <MemberMembershipItem
                                    label="Descripción del plan"
                                >
                                    {{
                                        $filters.capitalize(
                                            member.membership.description
                                        )
                                    }}
                                </MemberMembershipItem>

                                <MemberMembershipItem label="Precio contratado">
                                    USD {{ member.membership.pivot.price }}
                                </MemberMembershipItem>

                                <MemberMembershipItem label="Fecha de inicio">
                                    {{ member.membership.pivot.start_date }}
                                </MemberMembershipItem>

                                <MemberMembershipItem
                                    label="Fecha de finalización"
                                >
                                    {{ member.membership.pivot.end_date }}
                                </MemberMembershipItem>

                                <MemberMembershipItem label="Status de pago">
                                    Sin pago
                                </MemberMembershipItem>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </Page>
    </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from "@/Layouts/AppLayout.vue";
import Page from "@/Layouts/Page.vue";
import { Member } from "./Member";
import MemberMembershipItem from "@/Components/Members/MemberMembershipItem.vue";

defineProps<{
    member: any;
}>();
</script>
