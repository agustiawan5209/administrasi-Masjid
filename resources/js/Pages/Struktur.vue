<script setup>
import { Head, Link } from '@inertiajs/vue3';
import HomeLayout from '@/Layouts/HomeLayout.vue'

import PrimaryButton from '@/Components/PrimaryButton.vue';
import CarouselHeader from '@/Components/CarouselHeader.vue'
import { ref, defineProps } from 'vue'
const props = defineProps({
    struktur: {
        type: Object,
        default: () => ({}),
    },
})

</script>

<template>
    <HomeLayout>

        <Head title="Jadwal kajian" />
        <div class="container mx-auto overflow-hidden px-6 2xl:px-0 xl:max-w-7xl">
            <div class="flex flex-col gap-6 md:gap-16 pb-16 pt-6">
                <div>
                    <div class="flex flex-col lg:items-center pt-6 md:pt-16 gap-6 mb-10">
                        <h1 class="text-[32px] md:text-4xl font-medium leading-[51px] md:leading-[58px] text-gray-900">
                           Struktur Masjid ISMUL A’ZHAM MAKASSAR
                        </h1>
                        <div class="w-96 border-2 border-green-600"></div>
                    </div>
                </div>
                <transition  name="fade">
                    <main class="container mx-auto" >
                        <img :src="struktur.path_gambar" class="w-full" :alt="struktur.path_gambar">
                        <h2 class="text-blue-800 font-bold leading-6 text-center">
                            {{ struktur.name }}
                        </h2>
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
