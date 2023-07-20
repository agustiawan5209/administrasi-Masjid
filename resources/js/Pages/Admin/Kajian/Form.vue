<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';


const AddForm = useForm({
    tanggal: '',
    judul: '',
    uztadz: '',
    ket: '',
    penanggung_jawab: '',
})

function submit() {
    AddForm.post(route('Kajian.store'),{
        onFinish: ()=>{
            AddForm.reset()
        }
    });
}
</script>

<template>
    <AuthenticatedLayout>

        <Head title="Form Kajian" />
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Form Jadwal Kajian</h2>
        </template>
        <section class="py-3 flex justify-center w-full">
            <div class="max-w-2xl">
                <form @submit.prevent="submit" class="w-full grid grid-cols-2 gap-7 bg-white px-4 py-3 rounded-lg shadow-md">
                    <div class="block">
                        <InputLabel value="Tanggal Kajian" />
                        <TextInput type="date" id="tanggal" v-model="AddForm.tanggal" />
                        <InputError :message="AddForm.errors.tanggal"  />
                    </div>
                    <div class="block">
                        <InputLabel value="judul Kajian" />
                        <TextInput type="text" v-model="AddForm.judul"/>
                        <InputError :message="AddForm.errors.judul" />
                    </div>
                    <div class="block">
                        <InputLabel value="Uztadz" />
                        <TextInput type="text" v-model="AddForm.uztadz" />
                        <InputError :message="AddForm.errors.uztadz" />
                    </div>
                    <div class="block">
                        <InputLabel value="Penanggung Jawab Kajian" />
                        <TextInput type="text" v-model="AddForm.penanggung_jawab" />
                        <InputError :message="AddForm.errors.penanggung_jawab" />
                    </div>
                    <div class=" col-span-2 block">
                        <InputLabel value="Keterangan Kajian" />
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
