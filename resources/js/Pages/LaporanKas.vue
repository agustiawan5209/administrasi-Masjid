<script setup>
import { Head, Link } from '@inertiajs/vue3';
import HomeLayout from '@/Layouts/HomeLayout.vue'

import PrimaryButton from '@/Components/PrimaryButton.vue';
import CarouselHeader from '@/Components/CarouselHeader.vue'
import { ref, defineProps } from 'vue'
const props = defineProps({
    kas: {
        type: Object,
        default: () => ({}),
    },
})

const rupiah = (number) => {
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR"
    }).format(number);
}

</script>

<template>
    <HomeLayout>

        <Head title="Jadwal kajian" />
        <div class="container mx-auto overflow-hidden px-6 2xl:px-0 xl:max-w-7xl">
            <div class="flex flex-col gap-6 md:gap-16 pb-16 pt-6">
                <div>
                    <div class="flex flex-col lg:items-center pt-6 md:pt-16 gap-6">
                        <h1 class="text-[32px] md:text-4xl font-medium leading-[51px] md:leading-[58px] text-gray-900">
                            Laporan Kas Keuangan Masjid ISMUL A’ZHAM MAKASSAR
                        </h1>
                        <div class="w-96 border-2 border-green-600"></div>
                    </div>
                </div>
                <transition  name="fade">
                    <main class="flex"  >
                        <div class="flex flex-col justify-between gap-8 w-full h-full" v-if="kas.length > 0">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                                    <tr>
                                        <th scope="col" class=" border">No.</th>
                                        <th scope="col" class="px-4 py-3 border">Tanggal</th>
                                        <th scope="col" class="px-4 py-3 border">Kas Masuk</th>
                                        <th scope="col" class="px-4 py-3 border text-xs">Keterangan Kas Masuk</th>
                                        <th scope="col" class="px-4 py-3 border">Kas Keluar</th>
                                        <th scope="col" class="px-4 py-3 border text-xs">Keterangan Kas Keluar</th>
                                        <th scope="col" class="px-4 py-3 border">Total Kas</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in kas" class="border-b ">
                                        <th class="border text-center">{{ index + 1 }}.</th>

                                        <th scope="row"
                                            class="px-2 py-1 border font-medium text-gray-900 whitespace-nowrap text-start ">
                                            {{ item.tanggal }}</th>
                                        <td class="px-2 py-1 border">{{ rupiah(item.kas_masuk) }}</td>
                                        <td class="px-2 py-1 border w-1/12">
                                            <p class="text-xs whitespace-pre-wrap" v-html="item.ket_kas_masuk"></p>
                                        </td>
                                        <td class="px-2 py-1 border">{{ rupiah(item.kas_keluar) }}</td>
                                        <td class="px-2 py-1 border w-1/12">
                                            <p class="text-xs whitespace-pre-wrap" v-html="item.ket_kas_keluar"></p>
                                        </td>
                                        <td class="px-2 py-1 border">{{ rupiah(item.total_kas) }}</td>

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
                                            Laporan Kas Tidak ada
                                        </h2>
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
