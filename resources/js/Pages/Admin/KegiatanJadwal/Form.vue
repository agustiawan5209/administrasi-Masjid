<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';


const AddForm = useForm({
    tanggal: null,
    waktu: null,
    kegiatan: null,
    tempat: null,
    ket: null,
    penanggung_jawab: null,
})

function submit() {
    AddForm.post(route('Kegiatan.store'));
}
</script>

<template>
    <AuthenticatedLayout>

        <Head title="Form Kegiatan" />
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Form Kegiatan Jadwal</h2>
        </template>
        <section class="py-3 flex justify-center w-full">
            <div class="max-w-2xl">
                <form @submit.prevent="submit" class="w-full grid grid-cols-2 gap-7 bg-white px-4 py-3 rounded-lg shadow-md">
                    <div class="block">
                        <InputLabel value="Tanggal Kegiatan" />
                        <TextInput type="date" v-model="AddForm.tanggal" aria-placeholder="18/19/2023" />
                        <InputError :message="AddForm.errors.tanggal"  />
                    </div>
                    <div class="block">
                        <InputLabel value="Waktu Kegiatan" />
                        <TextInput type="text" v-model="AddForm.waktu" placeholder="dzuhur,azhar,maghrib"/>
                        <InputError :message="AddForm.errors.waktu" />
                    </div>
                    <div class="block">
                        <InputLabel value="Judul Kegiatan" />
                        <TextInput type="text" v-model="AddForm.kegiatan" />
                        <InputError :message="AddForm.errors.kegiatan" />
                    </div>
                    <div class="block">
                        <InputLabel value="Tempat Kegiatan" />
                        <TextInput type="text" v-model="AddForm.tempat" />
                        <InputError :message="AddForm.errors.tempat" />
                    </div>
                    <div class="block">
                        <InputLabel value="Penanggung Jawab Kegiatan" />
                        <TextInput type="text" v-model="AddForm.penanggung_jawab" />
                        <InputError :message="AddForm.errors.penanggung_jawab" />
                    </div>
                    <div class=" col-span-2 block">
                        <InputLabel value="Keterangan Kegiatan" />
                        <textarea class="w-full rounded-sm border border-gray-400" rows="5" v-model="AddForm.ket" ></textarea>
                        <InputError :message="AddForm.errors.ket" />

                    </div>


                    <div class="col-span-2">
                        <PrimaryButton type="submit" class="w-full text-center">Simpan</PrimaryButton>
                    </div>
                </form>
            </div>
        </section>

    </AuthenticatedLayout>
</template>
