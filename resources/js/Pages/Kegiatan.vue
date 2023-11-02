<script setup>
import { Head, Link } from '@inertiajs/vue3';
import HomeLayout from '@/Layouts/HomeLayout.vue'

import PrimaryButton from '@/Components/PrimaryButton.vue';
import CarouselHeader from '@/Components/CarouselHeader.vue'
import { ref, defineProps } from 'vue'
const props = defineProps({
    kegiatan_hari_ini: {
        type: Object,
        default: () => ({}),
    },
    kegiatan_bulan_ini: {
        type: Object,
        default: () => ({}),
    },
    semua_kegiatan: {
        type: Object,
        default: () => ({}),
    },
})

const VKegiatan = ref('soon');
const activeClass = 'bg-success text-white font-bold rounded-[44px]';
const NonactiveClass = 'text-gray-400';
</script>

<template>
    <HomeLayout>

        <Head title="Jadwal Kegiatan" />
        <div class="container mx-auto overflow-hidden px-6 2xl:px-0 xl:max-w-7xl">
            <div class="flex flex-col gap-6 md:gap-16 pb-16 pt-6">
                <div>
                    <div class="flex flex-col lg:items-center pt-6 md:pt-16 gap-6 mb-10">
                        <h1 class="text-[32px] md:text-4xl font-medium leading-[51px] md:leading-[58px] text-gray-900">
                            Kegiatan Masjid ISMUL A’ZHAM MAKASSAR
                        </h1>
                        <div class="w-96 border-2 border-green-600"></div>
                    </div>
                    <div class="flex justify-center">
                        <div
                            class="switch-time w-full sm:w-80 h-14 rounded-3xl bg-gray-200 flex items-center justify-center">
                            <button @click="VKegiatan = 'today'" :class="VKegiatan == 'today' ? activeClass :NonactiveClass"
                                class="w-40 h-11 px-4 py-3 m-1 flex items-center justify-center  transition-all delay-75">
                                Semua Kegiatan
                            </button>
                            <button @click="VKegiatan = 'soon'" :class="VKegiatan == 'soon' ? activeClass :NonactiveClass"
                                class="w-40 h-11 px-4 py-3 m-1 flex items-center justify-center  transition-all delay-75">
                                Hari Ini
                            </button>
                        </div>
                    </div>
                </div>
                <transition  name="fade">
                    <main class="flex lg:gap-44"  v-if="VKegiatan == 'today'" :key="VKegiatan">
                        <div class="flex flex-col justify-between gap-8 w-full h-full" v-if="kegiatan_hari_ini.length > 0">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                                    <tr>
                                        <th scope="col" class="px-4 py-3 border">No.</th>
                                        <th scope="col" class="px-4 py-3 border">Tanggal</th>
                                        <th scope="col" class="px-4 py-3 border">Waktu</th>
                                        <th scope="col" class="px-4 py-3 border">Kegiatan</th>
                                        <th scope="col" class="px-4 py-3 border">Tempat</th>
                                        <th scope="col" class="px-4 py-3 border">Ket</th>
                                        <th scope="col" class="px-4 py-3 border">Penanggung Jawab</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item,index) in semua_kegiatan" class="border-b ">
                                        <th class="border text-center">{{ index+1 }}.</th>

                                        <th scope="row"
                                            class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap text-start ">
                                            {{ item.tanggal }}</th>
                                        <td class="px-4 py-3 border">{{ item.waktu }}</td>
                                        <td class="px-4 py-3 border">{{ item.kegiatan }}</td>
                                        <td class="px-4 py-3 border">{{ item.tempat }}</td>
                                        <td class="px-4 py-3 border">
                                            <p v-html="item.ket"></p>
                                        </td>
                                        <td class="px-4 py-3 border">{{ item.penanggung_jawab }}</td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="flex flex-col justify-between gap-8 w-full h-full" v-else>
                            <div class="w-full h-96">
                                <div class="w-full h-full flex flex-col justify-center items-center gap-8">
                                    <div class="flex justify-center items-center w-32 h-32 bg-gray-100 rounded-full">
                                        <img src="/icons/empty-activities.svg" alt="Ikon agenda kosong" width="56" height="69">
                                    </div>
                                    <div class="flex flex-col justify-center items-center">
                                        <h2 class="text-blue-800 font-bold leading-6 text-center">
                                            Tidak ada kegiatan di hari ini
                                        </h2>
                                        <p class="text-gray-500 text-sm font-light leading-6 text-center">
                                            Silakan lihat agenda akan datang atau lihat kegiatan lainnya.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                    <main class="flex"  v-else-if="VKegiatan == 'soon'" :key="VKegiatan">
                        <div class="flex flex-col justify-between gap-8 w-full h-full" v-if="kegiatan_bulan_ini.length > 0">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                                    <tr>
                                        <th scope="col" class="px-4 py-3 border">No.</th>
                                        <th scope="col" class="px-4 py-3 border">Tanggal</th>
                                        <th scope="col" class="px-4 py-3 border">Waktu</th>
                                        <th scope="col" class="px-4 py-3 border">Kegiatan</th>
                                        <th scope="col" class="px-4 py-3 border">Tempat</th>
                                        <th scope="col" class="px-4 py-3 border">Ket</th>
                                        <th scope="col" class="px-4 py-3 border">Penanggung Jawab</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item,index) in kegiatan_hari_ini" class="border-b ">
                                        <th class="border text-center">{{ index+1 }}.</th>

                                        <th scope="row"
                                            class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap text-start ">
                                            {{ item.tanggal }}</th>
                                        <td class="px-4 py-3 border">{{ item.waktu }}</td>
                                        <td class="px-4 py-3 border">{{ item.kegiatan }}</td>
                                        <td class="px-4 py-3 border">{{ item.tempat }}</td>
                                        <td class="px-4 py-3 border">
                                            <p v-html="item.ket"></p>
                                        </td>
                                        <td class="px-4 py-3 border">{{ item.penanggung_jawab }}</td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="flex flex-col justify-between gap-8 w-full h-full" v-else>
                            <div class="w-full h-96">
                                <div class="w-full h-full flex flex-col justify-center items-center gap-8">
                                    <div class="flex justify-center items-center w-32 h-32 bg-gray-100 rounded-full">
                                        <img src="/icons/empty-activities.svg" alt="Ikon agenda kosong" width="56" height="69">
                                    </div>
                                    <div class="flex flex-col justify-center items-center">
                                        <h2 class="text-blue-800 font-bold leading-6 text-center">
                                            Tidak ada kegiatan yang akan datang
                                        </h2>
                                        <p class="text-gray-500 text-sm font-light leading-6 text-center">
                                            Silakan lihat agenda hari ini
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                </transition>
            </div>
        </div>
    </HomeLayout>
</template>


<style>
/*
  Enter and leave animations can use different
  durations and timing functions.
*/
.fade-enter-active {
    transition: all 0.3s ease-out;
  }

  .fade-leave-active {
    transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
  }

  .fade-enter-from {
    transform: translateX(-100%);
    opacity: 0;
  }
  .fade-leave-to {
    transform: translateX(100%);
    opacity: 0;
  }
</style>
