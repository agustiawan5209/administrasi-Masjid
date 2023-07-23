<script setup>
import { Head, Link } from '@inertiajs/vue3';
import HomeLayout from '@/Layouts/HomeLayout.vue'

import PrimaryButton from '@/Components/PrimaryButton.vue';
import CarouselHeader from '@/Components/CarouselHeader.vue'
import { ref } from 'vue'
const props = defineProps({
    jadwal_shalat: {
        type: Object,
        default: () => ({}),
    },
    jadwal_kajian: {
        type: Object,
        default: () => ({}),
    },
})

</script>

<template>
    <HomeLayout>

        <Head title="Artikel" />

        <section class="container mx-auto grid grid-cols-12 gap-8 py-5">

            <div class="col-span-7">
                <h1 class="text-2xl">Terbaru</h1>

                <article
                    class="flex flex-col items-center w-full bg-white border border-gray-200 rounded-lg md:flex-row shadow hover:bg-gray-100">
                    <img class="object-cover w-1/3 rounded-t-lg h-64 rounded-l-lg" src="/img/masjid (1).jpg" alt="">
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Noteworthy
                            technology
                            acquisitions 2021</h5>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise
                            technology
                            acquisitions of 2021 so far, in reverse chronological order.</p>
                        <PrimaryButton>Selengkapnya</PrimaryButton>
                    </div>
                </article>
            </div>
            <aside class="col-span-5">
                <h1 class="text-2xl">Lainnya</h1>

                <article
                    class="flex flex-col items-center w-full bg-white border border-gray-200 rounded-lg md:flex-row shadow hover:bg-gray-100">
                    <img class="object-cover w-1/3 rounded-t-lg h-64 rounded-l-lg" src="/img/masjid (1).jpg" alt="">
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Noteworthy
                            technology
                            acquisitions 2021</h5>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise
                            technology
                            acquisitions of 2021 so far, in reverse chronological order.</p>
                        <PrimaryButton>Selengkapnya</PrimaryButton>
                    </div>
                </article>


            </aside>

        </section>
</HomeLayout></template>
