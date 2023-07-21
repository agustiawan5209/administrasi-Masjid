<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectInput from '@/Components/SelectInput.vue';
import { ref, defineProps } from 'vue';
import axios from 'axios';
const props = defineProps({
    donatur: {
        type: Object,
        default: () => ({}),
    }
})
const AddForm = useForm({
    bukti: null,
    tanggal: '',
    donatur_id: '',
    nama_donatur: '',
    jenis: '',
    jumlah: '',
    ket: '',
})
const UrlFile = ref(null);

function fileSelected(e) {
    AddForm.bukti = e.target.files[0];
    UrlFile.value = URL.createObjectURL(e.target.files[0])
}
function submit() {
    AddForm.post(route('DataDonatur.store'), {
        onSuccess: () => {
            AddForm.reset()
        }
    });
}
function DonaturSelected(e) {
    console.log(e.target.value)
    axios({
        method:'get',
        url: route('DataDonatur.getDonatur', {id:e.target.value}),
        responseType: 'json',
    }).then((res)=>{
        const data = res.data;
        AddForm.nama_donatur = data.nama;
    }).catch(err=>console.log(err))
 }
 const JenisDataDonatur = ['Uang', 'Materi','Lainnya'];
</script>

<template>
    <AuthenticatedLayout>

        <Head title="Form Donatur" />
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Form Data Donatur</h2>
        </template>
        <section class="container mx-auto grid justify-center">
            <div class="max-w-4xl">
                <form @submit.prevent="submit" class="w-full block bg-white px-4 py-3 rounded-lg shadow-md">
                    <div class="col-span-2 mb-2">
                        <label for="dropzone-file" v-if="AddForm.bukti == null"
                            class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Masukan
                                        Gambar</span></p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)
                                </p>
                            </div>
                            <input id="dropzone-file" type="file" @input="fileSelected($event)" class="hidden" />
                        </label>
                        <img v-else :src="UrlFile" alt="">
                        <InputError :message="AddForm.errors.bukti" />

                    </div>
                    <div class="w-full mb-2">
                        <InputLabel value="Tanggal" />
                        <TextInput type="date" id="tanggal" v-model="AddForm.tanggal" />
                        <InputError :message="AddForm.errors.tanggal" />
                    </div>
                    <div class="w-full mb-2">
                        <InputLabel value="Pilih Donatur" />
                        <select id="countries" v-model="AddForm.donatur_id" @change="DonaturSelected($event)"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">--</option>
                            <option v-for="item in donatur" :value="item.id">{{ item.nama }}</option>
                        </select>
                        <InputError :message="AddForm.errors.donatur_id" />
                    </div>
                    <div class="w-full mb-2">
                        <InputLabel value="nama Donatur" />
                        <TextInput type="text" id="nama_donatur" v-model="AddForm.nama_donatur" />
                        <InputError :message="AddForm.errors.nama_donatur" />
                    </div>
                    <div class="w-full mb-2">
                        <InputLabel value="jenis Donatur" />
                        <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm placeholder:text-gray-300 w-full"  v-model="AddForm.jenis" >
                            <option value="">---</option>
                            <option v-for="je in JenisDataDonatur" :value="je">{{je}}</option>
                        </select>
                        <InputError :message="AddForm.errors.jenis" />
                    </div>
                    <div class="w-full mb-2">
                        <InputLabel value="Jumlah" />
                        <TextInput type="text" v-model="AddForm.jumlah" />
                        <InputError :message="AddForm.errors.jumlah" />
                    </div>
                    <div class=" col-span-2 w-full">
                        <InputLabel value="Keterangan" />
                        <quill-editor theme="snow" v-model:content="AddForm.ket" contentType="html"
                            class="block p-2.5 w-full text-sm   rounded-lg border  focus:ring-primary focus:border-primary bg-gray-100 border-gray-600 placeholder-gray-400 text-gray-800 " />
                        <InputError :message="AddForm.errors.ket" />
                    </div>
                    <div class="col-span-2 mt-20">
                        <PrimaryButton type="submit" class="w-full text-center">Simpan</PrimaryButton>
                    </div>
                </form>
            </div>
        </section>

    </AuthenticatedLayout>
</template>
