<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';


const AddForm = useForm({
    jenis: '',
    tanggal: '',
    hari: '',
    waktu: '',
    jam: '',
    muadzin: '',
    khotbah: '',
    imam: '',
})

function submit() {
    AddForm.post(route('JadwalShalat.store'));
}
const Hari = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu']
</script>

<template>
    <AuthenticatedLayout>

        <Head title="Form Kegiatan" />
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Form Jadwal Shalat</h2>
        </template>
        <section class="py-3 container mx-auto">
            <div class="w-full">
                <form @submit.prevent="submit"
                    class="w-full gap-7 bg-white px-4 py-3 rounded-lg shadow-md">
                    <div class="flex items-center justify-center py-3 space-x-4">
                        <div class="flex items-center gap-4">
                            <input type="radio" v-model="AddForm.jenis" value="shalat_wajib"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" />
                            <InputLabel value="Shalat wajib" />
                        </div>
                        <div class="flex items-center gap-4">
                            <input type="radio" v-model="AddForm.jenis" value="jumat"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" />
                            <InputLabel value="Shalat Jumat" />
                        </div>
                        <InputError :message="AddForm.errors.jenis" />
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-5 max-w-full">
                        <div>
                            <div class="block">
                                <InputLabel value="Tanggal Shalat" />
                                <TextInput type="date" v-model="AddForm.tanggal" />
                                <InputError :message="AddForm.errors.tanggal" />
                            </div>

                            <div class="block">
                                <InputLabel value="Hari" />
                                <select type="text" v-model="AddForm.hari"
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm placeholder:text-gray-300 w-full">
                                    <option value="">---</option>
                                    <option v-for="day in Hari" :value="day" class="capitalize">{{ day }}</option>
                                </select>
                                <InputError :message="AddForm.errors.hari" />
                            </div>
                            <div class="block">
                                <InputLabel value="Waktu Shalat" />
                                <TextInput type="text" v-model="AddForm.waktu" placeholder="dzuhur,azhar,maghrib,isya,subuh"/>
                                <InputError :message="AddForm.errors.waktu" />
                            </div>
                            <div class="block">
                                <InputLabel value="Jam Shalat" />
                                <TextInput type="time" v-model="AddForm.jam" placeholder="00:00" />
                                <InputError :message="AddForm.errors.jam" />
                            </div>
                        </div>

                        <div>
                            <div class="block" v-if="AddForm.jenis == 'jumat'">
                                <InputLabel value="Muadzin Jum'at" />
                                <TextInput type="text" v-model="AddForm.muadzin" />
                                <InputError :message="AddForm.errors.muadzin" />
                            </div>
                            <div class="block" v-if="AddForm.jenis == 'jumat'">
                                <InputLabel value="Pembawa Khotbah Jum'at" />
                                <TextInput type="text" v-model="AddForm.khotbah" />
                                <InputError :message="AddForm.errors.khotbah" />
                            </div>
                            <div class="block" v-if="AddForm.jenis == 'jumat'">
                                <InputLabel value="Imam Jum'at" />
                                <TextInput type="text" v-model="AddForm.imam" />
                                <InputError :message="AddForm.errors.imam" />
                            </div>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <PrimaryButton type="submit" class="w-full text-center">Simpan</PrimaryButton>
                    </div>
                </form>
            </div>
        </section>

    </AuthenticatedLayout>
</template>
