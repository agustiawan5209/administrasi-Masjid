<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { defineProps, ref, watch } from 'vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import Modal from '@/Components/Modal.vue';
import Pagination from '@/Components/Pagination.vue';
import FlashMessage from '@/Components/FlashMessage.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SelectInput from '@/Components/SelectInput.vue';
import axios from 'axios';
const props = defineProps({
    kas: {
        type: Object,
        default: () => ({}),
    },
    search: String,
    total_saldo: Number
})
// Search Form
const SearchForm = useForm({});
const search = ref(props.search);

watch(search, (value) => {
    SearchForm.get(route('Laporan.keuangan-bendahara', {
        search: value,
    }), {
        preserveState: true,
        preserveScroll: true,
    });
})


// Modal
const modalDelete = ref(false);
function showModaldelete(param) {
    modalDelete.value = true;
    FormDelete.slug = param;
}
function closeModal() {
    modalDelete.value = false;
    FormDelete.slug = null;
}


const rupiah = (number) => {
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR"
    }).format(number);
}

const FormTanggal = useForm({
    max_date: '',
    min_date: '',
})


function CariTanggal() {
    FormTanggal.get(route("Laporan.keuangan-bendahara"), {
        preserveState: true,
        preserveScroll: true,
    })
}
let config = {
    responseType: 'blob',
}
function exportExcel(){
    axios.get(route('Laporan.keuangan-Export-Excel',{
        max_date: FormTanggal.max_date,
        min_date: FormTanggal.min_date,
    }), config).then((res)=>{
       var fileExcel = URL.createObjectURL(new Blob([res.data]));
       var fileLink = document.createElement('a');
       fileLink.href  = fileExcel;
       fileLink.setAttribute('download', 'kasMasjid.xlsx')
    //    document.body.appendChild(fileLink);
       fileLink.click()
    }).catch(err=>console.log(err))
}
function exportPDF(){
    axios.get(route('Laporan.keuangan-Export-PDF',{
        max_date: FormTanggal.max_date,
        min_date: FormTanggal.min_date,
    }), config).then((res)=>{
       var fileExcel = URL.createObjectURL(new Blob([res.data]));
       var fileLink = document.createElement('a');
       fileLink.href  = fileExcel;
       fileLink.setAttribute('download', 'kasMasjid.pdf')
    //    document.body.appendChild(fileLink);
       fileLink.click()
    }).catch(err=>console.log(err))
}
</script>

<template>
    <Head title="donatur" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Data Donatur</h2>
            <FlashMessage />
        </template>

        <div class="py-4">
            <section class="bg-transparent px-3 sm:px-5">
                <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                    <!-- Start coding here -->
                    <div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden">
                        <div
                            class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                            <!-- <div class="w-full">
                                <h6>Total Kas : <span>{{ rupiah(total_saldo) }}</span></h6>
                            </div> -->

                            <div class="w-max">
                                <form class="flex justify-around items-end gap-2">
                                    <div>
                                        <InputLabel value="Tanggal Awal" />
                                        <TextInput type="date" v-model="FormTanggal.max_date" />
                                    </div>
                                    <div>
                                        <InputLabel value="Tanggal Akhir" />
                                        <TextInput type="date" v-model="FormTanggal.min_date" />
                                    </div>
                                    <div class="flex items-start h-full">
                                        <PrimaryButton type="button" @click="CariTanggal">Filter</PrimaryButton>
                                    </div>
                                </form>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                <PrimaryButton @click="exportPDF()" type="button" class=" !bg-transparent !border-red-600 !text-red-500 active:text-red-800 hover:bg-transparent focus:bg-transparent active:bg-transparent focus:ring-trabg-transparent">
                                    <span>PDF</span>
                                    <img :src="'/svg/pdf-file.svg'" alt="" class="w-6 h-6">

                                </PrimaryButton>
                                <PrimaryButton @click="exportExcel()" type="button" class="!bg-transparent !border-green-600 !text-green-500 active:text-green-800 hover:bg-transparent focus:bg-transparent active:bg-transparent focus:ring-green-500">
                                    <span>Excel</span>
                                    <img :src="'/svg/excel-document.svg'" alt="" class="w-6 h-6">
                                </PrimaryButton>
                                <!-- <Link :href="route('Laporan.keuangan-Export-Excel')">
                                </Link> -->

                            </div>
                        </div>
                        <div class="overflow-x-auto px-2 pb-5">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                                    <tr>
                                        <th scope="col" class=" border">No.</th>
                                        <th scope="col" class="px-4 py-3 border">Tanggal</th>
                                        <th scope="col" class="px-4 py-3 border">Kode</th>
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
                                        <th scope="row"
                                            class="px-2 py-1 border font-medium text-gray-900 whitespace-nowrap text-start ">
                                            {{ item.kode }}</th>
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
                    </div>
                </div>
            </section>
        </div>
    </AuthenticatedLayout>
</template>
