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

const time = ref(null)
const date = ref(null)
// const interval = setInterval(() => {
//     time.value = Intl.DateTimeFormat(navigator.language, {
//         hour: 'numeric',
//         minute: 'numeric',
//         second: 'numeric'
//     }).format()
// }, 1000);
// interval
// console.log(time.value)


var week = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];
var timerID = setInterval(updateTime, 1000);
updateTime();
function updateTime() {
    var cd = new Date();
    time.value = zeroPadding(cd.getHours(), 2) + ':' + zeroPadding(cd.getMinutes(), 2) + ':' + zeroPadding(cd.getSeconds(), 2);
    date.value = zeroPadding(cd.getFullYear(), 4) + '-' + zeroPadding(cd.getMonth() + 1, 2) + '-' + zeroPadding(cd.getDate(), 2) + ' ' + week[cd.getDay()];
};

function zeroPadding(num, digit) {
    var zero = '';
    for (var i = 0; i < digit; i++) {
        zero += '0';
    }
    return (zero + num).slice(-digit);
}
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
                    <h1 class="text-2xl font-bold text-white  z-50 drop-shadow-lg">Jadwal Shalat Hari
                        Ini</h1>
                    <time datetime="H:i:s" class="text-3xl text-white font-bold z-50 mb-2">{{ time }} WITA</time>
                    <!-- <time datetime="Y-m-d" class="text-3xl text-white font-bold z-50 mb-2">{{ date }}</time> -->
                    <ul class="grid grid-cols-5 bg-transparent px-5 w-full z-50 rounded-md overflow-hidden">
                        <li v-for="jadwal in jadwal_shalat.data"
                            class=" bg-primary border-r border-l border-white py-2 text-center text-xs sm:text-sm md:text-base lg:text-lg">
                            <dl>
                                <dt class="text-white font-bold text-base"><span class="border-b">{{ jadwal.waktu }}</span>
                                </dt>
                                <dd class="text-white text-sm">{{ jadwal.jam }} WITA</dd>
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
        <section class="container mx-auto text-center flex justify-center  relative">
            <div class=" bg-success w-full flex justify-center top-3.5 rounded-lg">
                <table class="w-1/2 z-20 bg-transparent my-5">
                    <caption class="text-2xl font-bold text-white">Kajian Hari ini</caption>
                    <thead class="bg-transparent">
                        <tr>
                            <th scope="col" class="px-2 py-1 border text-center text-white">Materi Kajian</th>
                            <th scope="col" class="px-2 py-1 border text-center text-white">Waktu Kajian</th>
                            <th scope="col" class="px-2 py-1 border text-center text-white">Pembawa Kajian</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="kajian in jadwal_kajian">
                            <td class="px-2 py-1 border text-center text-white">{{ kajian.judul }}</td>
                            <td class="px-2 py-1 border text-center text-white">{{ kajian.waktu }}</td>
                            <td class="px-2 py-1 border text-center text-white">{{ kajian.uztadz }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <!-- Card -->
        <section class="container mx-auto flex flex-wrap justify-center gap-10 my-5 place-content-start">
            <div class="w-1/3 h-72 bg-error overflow-hidden rounded-2xl shadow-sm">
                <img src="/img/masjid (1).jpg" class="object-cover w-full h-full object-bottom" alt="">
            </div>
            <div class="w-1/2 h-72 ">
                <div class="w-full h-max p-3 shadow-lg border border-gray-200 rounded-lg">
                    <h1 class="text-3xl text-success font-bold">Kajian</h1>
                    <p class="text-justify text-lg">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem cum deserunt necessitatibus
                        aliquam eius. Enim, illum numquam. Ratione quae eius sit at itaque molestias, atque blanditiis
                        reiciendis distinctio porro natus repellendus laudantium recusandae illo rem aut, animi sunt soluta!
                        Dolor, dolore porro quos ipsam nisi eum fugiat natus veritatis dolorem.
                    </p>
                    <Link :href="route('kajian-masjid')">
                    <PrimaryButton class="bg-success text-white">Selengkapnya</PrimaryButton>
                    </Link>

                </div>
            </div>
            <div class="w-1/2 h-72 ">
                <div class="w-full h-max p-3 shadow-lg border border-gray-200 rounded-lg">
                    <h1 class="text-3xl text-success font-bold">Jadwal Kegiatan</h1>
                    <p class="text-justify text-lg">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem cum deserunt necessitatibus
                        aliquam eius. Enim, illum numquam. Ratione quae eius sit at itaque molestias, atque blanditiis
                        reiciendis distinctio porro natus repellendus laudantium recusandae illo rem aut, animi sunt soluta!
                        Dolor, dolore porro quos ipsam nisi eum fugiat natus veritatis dolorem.
                    </p>
                    <Link :href="route('kegiatan-masjid')">
                    <PrimaryButton class="bg-success text-white">Selengkapnya</PrimaryButton>
                    </Link>
                </div>
            </div>
            <div class="w-1/3 h-72 bg-error overflow-hidden rounded-2xl shadow-sm">
                <img src="/img/masjid (2).jpg" class="object-cover w-full h-full object-bottom" alt="">
            </div>
        </section>
    </HomeLayout>
</template>
