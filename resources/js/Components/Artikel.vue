<script setup>
import { computed, onMounted, onUnmounted, watch } from 'vue';

import { Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    artikel: {
        type: Object,
        default: () => ({})
    },
    responsiveClass: {
        type: String,
        default: '',
    },
    MaxTextJudul: {
        type: String,
        default: 'text-sm',
    },
    MaxTextDesc: {
        type: String,
        default: 'text-sm',
    },
    maxWidthImage: {
        type: String,
        default: 'w-full',
    },
})

function truncateText(maxLength) {
    var paragraphs = maxLength
    var text = '';
    var paragraph = ''
    for (var i = 0; i < paragraphs.length; i++) {
        if (i < 100) {
            text += paragraphs[i]
        }
    }
    text += '........'
    return text;
}

const MaxTextJudulClass = computed(() => {
    return {
        sm: 'sm:text-sm',
        base: 'sm:text-base',
        lg: 'sm:text-lg',
        xl: 'sm:text-xl',
        '2xl': 'sm:text-2xl',
    }[props.MaxTextJudul];
});
const MaxTextDescClass = computed(() => {
    return {
        sm: 'sm:text-sm',
        base: 'sm:text-base',
        lg: 'sm:text-lg',
        xl: 'sm:text-xl',
        '2xl': 'sm:text-2xl',
    }[props.MaxTextDesc];
});

const maxWidthImageClass = computed(() => {
    return {
        full: 'w-full h-64',
        'whfull': 'w-full h-32',
        'w2': 'w-1/2 h-48',
        'w3': 'w-1/3 h-48',
        'w4': 'w-1/4 h-20',
    }[props.maxWidthImage];
});
</script>

<template>
    <article class="flex flex-col items-center w-full bg-white  border border-gray-200 rounded-lg shadow hover:bg-gray-100"
        :class="responsiveClass">
        <img class="object-cover object-bottom  rounded-t-lg rounded-l-lg" :class="maxWidthImageClass" src="/img/masjid (1).jpg" alt="">
        <div class="w-full p-4 leading-normal">
            <h5 class="mb-2 text-base font-bold tracking-tight text-gray-900 dark:text-white" :class="MaxTextJudulClass">
                {{ artikel.judul }}</h5>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400" :class="MaxTextDescClass" v-html="truncateText(artikel.isi)">

            </p>
            <PrimaryButton class="bg-primary">Selengkapnya</PrimaryButton>
        </div>
    </article>
</template>
