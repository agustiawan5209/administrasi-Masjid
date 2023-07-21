<script setup>
import NavLink from '@/Components/NavLink.vue';

</script>

<template>
    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
            Dashboard
        </NavLink>
        <NavLink :href="route('DataDonatur.index')" :active="route().current('DataDonatur.index') || route().current('DataDonatur.create') || route().current('DataDonatur.edit')">
            Data Donatur
        </NavLink>
        <NavLink :href="route('KasMasjid.index')" :active="route().current('KasMasjid.index') || route().current('KasMasjid.create') || route().current('KasMasjid.edit')">
            Data Transaksi
        </NavLink>
        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
            laporan Keuangan
        </NavLink>

    </div>
</template>
