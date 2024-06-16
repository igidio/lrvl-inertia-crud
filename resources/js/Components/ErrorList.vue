<script setup>
defineProps({
    errors: {
        tipe: Array,
        required: true
    }
})
</script>

<template>
    <ul v-if="errors" class="custom-bullet-list text-danger mt-3">
        <li v-for="error in errors">
            {{ error }}
        </li>
    </ul>
</template>

<style>
.custom-bullet-list {
    list-style-type: disc;
}
</style>