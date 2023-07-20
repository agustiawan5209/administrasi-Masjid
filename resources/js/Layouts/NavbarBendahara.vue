<script setup>
import NavLink from '@/Components/NavLink.vue';

</script>

<template>
    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
            Dashboard
        </NavLink>
        <NavLink :href="route('Donatur.index')" :active="route().current('Donatur.index') || route().current('Donatur.create') || route().current('Donatur.edit')">
            Data Donatur
        </NavLink>
        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
            Data Transaksi
        </NavLink>
        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
            laporan Keuangan
        </NavLink>

    </div>
</template>
