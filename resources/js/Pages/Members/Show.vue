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

                <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white p-6 rounded-md shadow-md">
                        <h2 class="text-xl font-bold mb-4">
                            Membership Information
                        </h2>
                        <p>
                            <strong>Plan:</strong>
                            {{ $filters.capitalize(member.membership.name) }}
                        </p>
                        <p>
                            <strong>Status:</strong>
                            {{ member.membership_status }}
                        </p>
                        <p><strong>Trainer:</strong> {{ member.trainer }}</p>
                        <p>
                            <strong>Joining Date:</strong>
                            {{ member.joining_date }}
                        </p>
                        <p>
                            <strong>Expiry Date:</strong>
                            {{ member.expiry_date }}
                        </p>
                    </div>

                    <div class="bg-white p-6 rounded-md shadow-md">
                        <h2 class="text-xl font-bold mb-4">
                            Contact Information
                        </h2>
                        <p><strong>City:</strong> {{ member.city }}</p>
                        <p><strong>State:</strong> {{ member.state }}</p>
                        <p><strong>Zipcode:</strong> {{ member.zipcode }}</p>
                        <p><strong>Phone:</strong> {{ member.phone }}</p>
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

defineProps<{
    member: any;
}>();
</script>
