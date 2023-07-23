<script setup>
import { Head, Link } from '@inertiajs/vue3';
import HomeLayout from '@/Layouts/HomeLayout.vue'
import { ref, defineProps } from 'vue';
import ArtikelVue from '@/Components/Artikel.vue'

const props  = defineProps({
    artikel:{
        type:Object,
        default:()=>({})
    },
    artikel_relate: {
        type: Object,
        default: () => ({}),
    },
});
</script>

<template>
    <HomeLayout>

        <Head :title="artikel.judul" />

        <section class="container mx-auto grid grid-cols-12 gap-8 py-5">

            <div class="col-span-7">
                <div class="w-full">
                   <transition name="fade">
                    <article>
                        <h1 class="text-xl sm:text-2xl md:text-3xl">{{artikel.judul}}</h1>
                        <figure>
                            <img :src="artikel.path_foto" :alt="artikel.judul" class="w-full mb-3">
                            <figcaption>
                                <time datetime="Y-m-d" class="text-white bg-primary rounded-lg font-medium text-base p-2 border mt-7">{{artikel.tanggal}}</time>
                            </figcaption>
                        </figure>
                        <p v-html="artikel.isi" class="leading-8 tracking-wide"></p>
                    </article>
                   </transition>
                </div>

            </div>
            <aside class="col-span-5">
                <h1 class="text-2xl">Lainnya</h1>

                <ArtikelVue v-for="(artikel, index) in artikel_relate.data" :responsiveClass="'md:flex-row mb-5'" :data-index="index" :artikel="artikel"  :MaxTextJudul="'base'" :MaxTextDesc="'sm'" :maxWidthImage="'w3'"></ArtikelVue>


            </aside>

        </section>
    </HomeLayout>
</template>


<style>
.fade-enter-active {
    transition: all 0.3s ease-out;
  }

  .fade-leave-active {
    transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
  }

  .fade-enter-from,
  .fade-leave-to {
    transform: translateX(30%);
    opacity: 0;
  }
</style>
