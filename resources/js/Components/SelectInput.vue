<script setup>
import { onMounted, ref } from 'vue';

</script>
<template>
    <select id="countries"
        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm placeholder:text-gray-300 w-full">
        <slot />
    </select>
</template>
