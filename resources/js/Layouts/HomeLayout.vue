<script setup>
import { Head, Link } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import CarouselHeader from '@/Components/CarouselHeader.vue'

</script>

<template>
    <header class="w-full bg-primary py-3">
        <div class="flex flex-wrap justify-between items-center px-5 sm:px-8 md:px-10 lg:px-20">
            <div class="flex flex-row justify-start items-center">
                <Link href="/">
                <ApplicationLogo class="w-10 md:w-20 h-10 md:h-20 fill-current text-gray-500" />
                </Link>
                <h1 class="flex flex-col sm:flex-row"><span>MASJID</span> <strong>ISMUL A’ZHAM MAKASSAR</strong></h1>
            </div>
            <Link :href="route('login')" class="text-xl font-bold underline drop-shadow-sm shadow-white">
            Masuk
            </Link>
        </div>
    </header>
    <nav class="bg-base-100 flex flex-wrap sm:flex-row items-center justify-between md:pr-10">
        <ul class="flex flex-wrap sm:flex-row md:space-x-6  md:pl-10 border-b-2 border-base-100">
            <li class="list-none group hover:bg-white py-3 border-black px-2 cursor-pointer">
                <a href="#"
                    class="group-hover:bg-white text-white text-xs sm:text-sm md:text-base group-hover:text-base-100 font-semibold">Home</a>
            </li>
            <li class="list-none group hover:bg-white py-3 border-black px-2 cursor-pointer">
                <a href="#"
                    class="group-hover:bg-white text-white text-xs sm:text-sm md:text-base group-hover:text-base-100 font-semibold">Struktur
                    Organisasi</a>
            </li>
            <li class="list-none group hover:bg-white py-3 border-black px-2 cursor-pointer">
                <a href="#"
                    class="group-hover:bg-white text-white text-xs sm:text-sm md:text-base group-hover:text-base-100 font-semibold">Tentang</a>
            </li>
            <li class="list-none group hover:bg-white py-3 border-black px-2 cursor-pointer">
                <a href="#"
                    class="group-hover:bg-white text-white text-xs sm:text-sm md:text-base group-hover:text-base-100 font-semibold">Pengumuman</a>
            </li>
            <li class="list-none group hover:bg-white py-3 border-black px-2 cursor-pointer">
                <a href="#"
                    class="group-hover:bg-white text-white text-xs sm:text-sm md:text-base group-hover:text-base-100 font-semibold">Jadwal
                    Kegiatan</a>
            </li>
            <li class="list-none group hover:bg-white py-3 border-black px-2 cursor-pointer">
                <a href="#"
                    class="group-hover:bg-white text-white text-xs sm:text-sm md:text-base group-hover:text-base-100 font-semibold">Kajian</a>
            </li>
        </ul>
        <form action="#" class="flex flex-row gap-0">
            <input type="search" class="border-collapse rounded-l-lg text-xs" placeholder="cari artikel" />
            <PrimaryButton class="border-none bg-primary px-2 py-2 rounded-l-none text-xs">Cari</PrimaryButton>
        </form>
    </nav>

    <main>
       <slot/>
    </main>
</template>

<style>
.carousel-header {
    height: 500px;
    overflow: hidden;
}

@media only screen and (max-width: 768px) {
    .carousel-header {
        height: 200px;
    }
}
</style>
