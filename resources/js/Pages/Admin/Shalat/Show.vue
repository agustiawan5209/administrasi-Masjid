<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link, Head } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    jadwal: {
        type:Object,
        default:()=>({})
    },
    tanggal:String
})
function back(){
    window.history.back();
}
</script>

<template>
    <AuthenticatedLayout>

        <Head title="Show" />
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Jadwal Shalat Wajib Tanggal :  {{tanggal}}</h2>
            <PrimaryButton @click="back()" class="!bg-base-100 text-white">Kembali</PrimaryButton>
        </template>

        <div class="py-4">
            <section class="bg-transparent px-3 sm:px-5">

                <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                    <div class="overflow-x-auto bg-white">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                                <tr class="bg-gray-400">
                                    <th scope="col" class="px-4 py-3 border">No.</th>
                                    <th scope="col" class="px-4 py-3 border">Waktu</th>
                                    <th scope="col" class="px-4 py-3 border">Jam</th>
                                    <th scope="col" class="px-4 py-3 border">Hari</th>
                                    <th scope="col" class="px-4 py-3 border">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody >
                                <tr v-for="(item, index) in jadwal" class="border-b ">
                                    <th class="border text-center">{{ index + 1 }}.</th>
                                    <td class="px-4 py-3 border">{{ item.waktu }}</td>
                                    <td class="px-4 py-3 border">{{ item.jam }}</td>
                                    <td class="px-4 py-3 border">{{ item.hari }}</td>
                                    <td class="px-4 py-3 border">{{ item.tanggal }}</td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </AuthenticatedLayout>
</template>
