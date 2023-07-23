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
                <Link :href="route('welcome')"
                    class="group-hover:bg-white text-white text-xs sm:text-sm md:text-base group-hover:text-base-100 font-semibold">Home</Link>
            </li>
            <li class="list-none group hover:bg-white py-3 border-black px-2 cursor-pointer">
                <a href="#"
                    class="group-hover:bg-white text-white text-xs sm:text-sm md:text-base group-hover:text-base-100 font-semibold">Tentang</a>
            </li>
            <li class="list-none group hover:bg-white py-3 border-black px-2 cursor-pointer">
                <a href="#"
                    class="group-hover:bg-white text-white text-xs sm:text-sm md:text-base group-hover:text-base-100 font-semibold">Struktur
                    Organisasi</a>
            </li>
            <li class="list-none group hover:bg-white py-3 border-black px-2 cursor-pointer">
                <Link :href="route('pengumuman')"
                    class="group-hover:bg-white text-white text-xs sm:text-sm md:text-base group-hover:text-base-100 font-semibold">Pengumuman</Link>
            </li>
            <li class="list-none group hover:bg-white py-3 border-black px-2 cursor-pointer">
                <Link :href="route('kegiatan-masjid')"
                    class="group-hover:bg-white text-white text-xs sm:text-sm md:text-base group-hover:text-base-100 font-semibold">Jadwal
                    Kegiatan</Link>
            </li>
            <li class="list-none group hover:bg-white py-3 border-black px-2 cursor-pointer">
                <Link :href="route('kajian-masjid')"
                    class="group-hover:bg-white text-white text-xs sm:text-sm md:text-base group-hover:text-base-100 font-semibold">Kajian</Link>
            </li>
        </ul>
        <form action="#" class="flex flex-row gap-0">
            <input type="search" class="border-collapse rounded-l-lg text-xs" placeholder="cari artikel" />
            <PrimaryButton class="border-none bg-primary px-2 py-2 rounded-l-none text-xs">Cari</PrimaryButton>
        </form>
    </nav>

    <main>
        <slot />
    </main>


    <footer class="bg-success rounded-lg shadow dark:bg-gray-900 m-4">
        <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <a href="/" class="flex items-center mb-4 sm:mb-0">
                  <ApplicationLogo class="w-20" />

                    <span class="self-center text-sm md:text-2xl font-semibold whitespace-nowrap text-white flex flex-col md:flex-row"><span>MASJID</span> <strong>ISMUL A’ZHAM MAKASSAR</strong></span>
                </a>
                <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-white sm:mb-0 dark:text-gray-400">
                    <li>
                        <a href="#" class="mr-4 hover:underline md:mr-6 ">About</a>
                    </li>
                    <li>
                        <a href="#" class="mr-4 hover:underline md:mr-6">Privacy Policy</a>
                    </li>
                    <li>
                        <a href="#" class="mr-4 hover:underline md:mr-6 ">Licensing</a>
                    </li>
                    <li>
                        <a href="#" class="hover:underline">Contact</a>
                    </li>
                </ul>
            </div>
            <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
            <span class="block text-sm text-white sm:text-center dark:text-gray-400">© 2023 <a
                    href="https://flowbite.com/" class="hover:underline">Flowbite™</a>. All Rights Reserved.</span>
        </div>
    </footer>
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
