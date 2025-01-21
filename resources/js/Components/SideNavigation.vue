<template>
    <div class="text-white h-screen bg-grey-200 dark:bg-gray-800 min-w-60">
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
                        v-for="item in sideNavigationItems"
                        :key="item.label"
                        :label="item.label"
                        :route="item.route"
                        :icon="item.icon"
                    />
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
import SideNavigationItem from "./SideNavigationItem.vue";

export default {
    components: {
        SideNavigationItem,
    },
    computed: {
        currentRoute() {
            return this.$route.path;
        },
    },
    data() {
        return {
            sideNavigationItems: [
                {
                    label: "Dashboard",
                    route: "/dashboard",
                    icon: "fa-home",
                },
                {
                    label: "Miembros",
                    route: "/members",
                    icon: "fa-users",
                },
                {
                    label: "Membresías",
                    route: "/memberships",
                    icon: "fa-id-card",
                },
                {
                    label: "Pagos",
                    route: "/payments",
                    icon: "fa-credit-card",
                },
            ],
        };
    },
};
</script>
