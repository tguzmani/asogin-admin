<template>
    <li>
        <Link
            :href="route"
            class="flex items-center gap-4 p-4 hover:bg-gray-700 rounded transition"
        >
            <!-- Dynamically render the icon component -->
            <v-icon :name="icon" fill="white" />
            <span class="text-white text-sm font-medium">{{ label }}</span>
        </Link>
    </li>
</template>

<script>
import { Link } from "@inertiajs/vue3";

export default {
    name: "SidebarItem",
    components: {
        Link,
    },
    props: {
        label: {
            type: String,
            required: true,
        },
        route: {
            type: String,
            required: true,
        },
        icon: {
            type: String,
            required: true,
        },
    },
};
</script>
