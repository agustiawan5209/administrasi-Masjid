<script setup>
import { Head, Link } from '@inertiajs/vue3';
import HomeLayout from '@/Layouts/HomeLayout.vue'

import PrimaryButton from '@/Components/PrimaryButton.vue';
import CarouselHeader from '@/Components/CarouselHeader.vue'
import { ref, defineProps } from 'vue'
const props = defineProps({
    kajian_hari_ini: {
        type: Object,
        default: () => ({}),
    },
    kajian_bulan_ini: {
        type: Object,
        default: () => ({}),
    },
    kajian: {
        type: Object,
        default: () => ({}),
    },
})

const Vkajian = ref('today');
const activeClass = 'bg-success text-white font-bold rounded-[44px]';
const NonactiveClass = 'text-gray-400';
</script>

<template>
    <HomeLayout>

        <Head title="Jadwal kajian" />
        <div class="container mx-auto overflow-hidden px-6 2xl:px-0 xl:max-w-7xl">
            <div class="flex flex-col gap-6 md:gap-16 pb-16 pt-6">
                <div>
                    <div class="flex flex-col lg:items-center pt-6 md:pt-16 gap-6 mb-10">
                        <h1 class="text-[32px] md:text-4xl font-medium leading-[51px] md:leading-[58px] text-gray-900">
                            Tentang Masjid ISMUL A’ZHAM MAKASSAR
                        </h1>
                        <div class="w-96 border-2 border-green-600"></div>
                    </div>
                </div>
                <p>
                    Patut kita sadari sadari bahwa hidup dizaman yang penuh dengan glamor serta fatamorgana akan keindahan
                    dunia merupakan sebuah tantangan yang besar, maka pantas jika banyak sekali ummat muslim saat ini belum
                    bisa memaksimalkan seluruh rangkaian ibadah seperti apa yg diajarkan oleh Rasulullah SAW.
                    <br><br>
                    Telah kita ketahui pada dasarnya Masjid yang mana menjadi salah satu pemenuhan kebutuhan spiritual
                    sebenarnya bukan hanya berfungsi sebagai tempat shalat saja, namun juga merupakan pusat kegiatan sosial
                    kemasyarakatan, serta pusat pendidikan agama ditegakan itu semua telah terjadi seperti yang telah
                    dicontohkan oleh Rasulullah saw pada zama kejayaan Islam saat itu. Beberapa ayat dalam Al-Qur’an yang
                    menyebutkan bahwa fungsi masjid adalah sebagai tempat yang didalamnya banyak menyebut nama Allah (tempat
                    berdzikir), tempat beri’tikaf, tempat beribadah (shalat), pusat pertemuan islam untuk membicarakan
                    urusan hidup dan perjuangan.
                    <br><br>
                    Perihal lain menegaskan bahwa sebuah hadist yang diriwayatkan oleh Tirmizi dari Abi Sa’id Al-Khudri
                    berbunyi bahwa setiap potongan tanah itu adalah masjid. Kemudian dalam hadist yang lain Nabi Muhammad
                    saw juga menerangkan, “telah dijadikan tanah itu masjid bagiku, tempat sujud”. Diamana Masjid yang
                    berasal dari kata sajada/sujud memiliki maksud bahwa kami mengikuti maupun menyesuaikan diri dengan
                    ketetapan Allah SWT akan seluruh keterkaitan yang ada di alam raya ini. Dalam perkembangannya saat ini
                    masjid sudah memiliki pengertian khusus dalam segi tata bahasanya, yakni suatu bangunan yang berfungsi
                    dipergunakan sebagai tempat shalat, baik shalat lima waktu,
                    <br><br>
                    Kemudian jika dikaitakan dengan kata masjid di Indonesia menjadi istilah yang baku, sehingga sering
                    sekali orang-orang awam yang menyebut kata-kata masjid maka yang dimaksudkan adalah tempat melaksanakan
                    shalat jumat dan juga setiap tempat shalat yang tidak dipergunakan untuk shalat jum’at maka tempat itu
                    tidak disebut masjid. Lantas apa yang perlu kita perbaiki dalam permasalahan terbut, dan apa sikap kita
                    yang tentunya tidak akan menimbulkan konflik besar, jawabannya adalah lebih bisa memberikan kontribusi
                    penuh terhadap masjid yang sebenarnya menjadi tempat pembangunan masyarakat. Wallahu A’lam

                </p>
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
