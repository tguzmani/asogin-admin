<script setup lang="ts">
import SideNavigationItem from "./SideNavigationItem.vue";
</script>

<template>
    <div class="text-white h-screen bg-grey-200 dark:bg-gray-800 w-60">
        <div
            id="asogin-administracion-logo"
            class="flex flex-col gap-2 py-6 border-solid border-b border-slate-600"
        >
            <div class="text-4xl font-bold text-center">Asogin</div>
            <div class="text-xl text-center text-slate-400">Administración</div>
        </div>

        <div id="side-nav-items" class="flex flex-col gap-2 p-4">
            <div class="flex flex-col gap-2">
                <ul class="flex flex-col gap-2">
                    <SideNavigationItem
                        label="Dashboard"
                        route="/dashboard"
                        icon="fa-home"
                    />

                    <SideNavigationItem
                        label="Miembros"
                        route="/members"
                        icon="fa-users"
                    />

                    <SideNavigationItem
                        label="Membresías"
                        route="/memberships"
                        icon="fa-id-card"
                    />
                </ul>
            </div>
        </div>
    </div>
</template>
