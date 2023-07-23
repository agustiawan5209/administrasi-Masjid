<script setup>
import { Head, Link } from '@inertiajs/vue3';
import HomeLayout from '@/Layouts/HomeLayout.vue'

import PrimaryButton from '@/Components/PrimaryButton.vue';
import CarouselHeader from '@/Components/CarouselHeader.vue'
import { ref, defineProps } from 'vue';
import ArtikelVue from '@/Components/Artikel.vue'
const props = defineProps({
    latest_artikel: {
        type: Object,
        default: () => ({}),
    },
    artikel_relate: {
        type: Object,
        default: () => ({}),
    },
    artikel_terbaru: {
        type: Object,
        default: () => ({}),
    },
})

</script>

<template>
    <HomeLayout>

        <Head title="Artikel" />

        <section class="container mx-auto grid grid-cols-12 md:gap-8 py-5">

            <div class=" col-span-12 md:col-span-7">
                <div class="w-full">
                    <h1 class="text-2xl">Terbaru</h1>
                    <ArtikelVue :artikel="latest_artikel" :maxWidthImage="'full'"  :MaxTextJudul="'2xl'" :MaxTextDesc="'base'"></ArtikelVue>

                </div>

                <div class="article terbaru mt-20">
                    <h3 class="text-2xl">Artikel Bulan Ini</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        <ArtikelVue v-for="(artikel, index) in artikel_terbaru.data" :responsiveClass="'2xl:flex-row mb-5 col'" :maxWidthImage="'whfull'" :data-index="index" :artikel="artikel"  :MaxTextJudul="'base'" :MaxTextDesc="'sm'">

                        </ArtikelVue>

                    </div>
                </div>
            </div>
            <aside class=" col-span-12 md:col-span-5">
                <h1 class="text-2xl">Lainnya</h1>
                <ArtikelVue v-for="(artikel, index) in artikel_relate.data" :responsiveClass="'md:flex-row mb-5 '" :data-index="index" :artikel="artikel"  :MaxTextJudul="'base'" :MaxTextDesc="'sm'" :maxWidthImage="'w3'"></ArtikelVue>


            </aside>

        </section>
    </HomeLayout>
</template>
