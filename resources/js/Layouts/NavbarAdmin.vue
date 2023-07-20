<script setup>
import NavLink from '@/Components/NavLink.vue';

</script>

<template>
    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
            Dashboard
        </NavLink>
        <NavLink :href="route('Struktur.index')" :active="route().current('Struktur.index')">
            Struktur Organisasi
        </NavLink>
        <NavLink :href="route('Kegiatan.index')" :active="route().current('Kegiatan.index')">
            Kegiatan Jadwal
        </NavLink>
        <NavLink :href="route('Kajian.index')" :active="route().current('Kajian.index')">
            jadwal Kajian
        </NavLink>
        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
            Data Donatur
        </NavLink>
        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
            Laporan
        </NavLink>
        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
            Pengumuman
        </NavLink>

    </div>
</template>
