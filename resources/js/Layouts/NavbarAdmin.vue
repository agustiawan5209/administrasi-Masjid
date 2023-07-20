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
        <NavLink :href="route('Kegiatan.index')" :active="route().current('Kegiatan.index') || route().current('Kegiatan.create') || route().current('Kegiatan.edit')">
            Kegiatan Jadwal
        </NavLink>
        <NavLink :href="route('Kajian.index')" :active="route().current('Kajian.index') || route().current('kajian.create') || route().current('kajian.edit')">
            jadwal Kajian
        </NavLink>
        <NavLink :href="route('Donatur.index')" :active="route().current('Donatur.index') || route().current('Donatur.create') || route().current('Donatur.edit')">
            Data Donatur
        </NavLink>
        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
            Laporan Kas
        </NavLink>
        <NavLink :href="route('Artikel.index')" :active="route().current('Artikel.index') || route().current('Artikel.create') || route().current('Artikel.edit')">
            Pengumuman
        </NavLink>

    </div>
</template>
