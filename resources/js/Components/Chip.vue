<template>
    <span :class="classes">
        <slot />
    </span>
</template>

<script>
export default {
    props: {
        bgcolor: String,
        color: String,
    },
    computed: {
        classes() {
            return `px-2.5 py-0.5 rounded-full text-xs font-medium ${this.bgcolor} ${this.color}`;
        },
    },
};
</script>
