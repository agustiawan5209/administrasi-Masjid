<script setup>
import { Head, Link } from '@inertiajs/vue3';
import HomeLayout from '@/Layouts/HomeLayout.vue'

import PrimaryButton from '@/Components/PrimaryButton.vue';
import CarouselHeader from '@/Components/CarouselHeader.vue'

const props = defineProps({
    jadwal_shalat:{
        type:Object,
        default:()=>({}),
    },
})
console.log(props.jadwal_shalat);
</script>

<template>
    <Head title="Home" />
    <HomeLayout>
         <!-- Carousel Header -->
         <section class="carousel-header flex flex-1 justify-between w-full relative overflow-hidden">
            <div
                class=" w-full md:w-1/2  h-full absolute flex flex-col justify-start items-center z-20 bg-transparent overflow-hidden">
                <div class="w-full h-full relative overflow-hidden flex flex-col items-center justify-center">
                    <div class="absolute w-full h-full bg-black opacity-30 z-20 top-0"></div>
                    <h1 class="text-2xl font-bold text-white mb-5 sm:mb-10 z-50 drop-shadow-lg">Jadwal Shalat Hari
                        Ini</h1>
                    <ul class="grid grid-cols-5 bg-transparent px-5 w-full z-50 rounded-md overflow-hidden">
                        <li v-for="jadwal in jadwal_shalat.data"
                            class=" bg-primary border-r border-l border-white py-2 text-center text-xs sm:text-sm md:text-base lg:text-lg">
                            <dl>
                                <dt class="text-base-100 font-bold text-base">{{ jadwal.waktu }}</dt>
                                <dd class="text-black text-sm">{{ jadwal.jam }} WITA</dd>
                            </dl>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="w-full h-full">
                <CarouselHeader />
            </div>
        </section>

        <!-- Jadwal Kegiatan -->
        <section class="container mx-auto h-max flex justify-center relative">
            <div class="absolute bg-success h-1/3 w-full top-1/4"></div>
            <table class="w-full z-20 bg-transparent">
                <caption>Kajian Hari ini</caption>
                <thead>
                    <tr>
                        <th scope="col">Materi Kajian</th>
                        <th scope="col">Pembawa Materi</th>
                        <th scope="col">Pembawa Materi</th>
                    </tr>
                </thead>
            </table>
        </section>
        <!-- Card -->
        <section class="container mx-auto flex flex-wrap justify-center gap-10 my-5 place-content-start">
            <div class="w-1/3 h-72 bg-error overflow-hidden">
                <img src="/img/masjid (1).jpg" class="object-cover w-full h-full object-bottom" alt="">
            </div>
            <div class="w-1/2 h-72 bg-info"></div>
            <div class="w-1/2 h-72 bg-info"></div>
            <div class="w-1/3 h-72 bg-error overflow-hidden">
                <img src="/img/masjid (2).jpg" class="object-cover w-full h-full object-bottom" alt="">
            </div>
            <div class="w-1/3 h-72 bg-error overflow-hidden">
                <img src="/img/masjid (3).jpg" class="object-cover w-full h-full object-bottom" alt="">
            </div>
            <div class="w-1/2 h-72 bg-info"></div>
        </section>
    </HomeLayout>
</template>
