<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';


const AddForm = useForm({
    nama: '',
    alamat: '',
    no_telpon: '',
})

function submit() {
    AddForm.post(route('Donatur.store'),{
        onFinish: ()=>{
            AddForm.reset()
        }
    });
}
</script>

<template>
    <AuthenticatedLayout>

        <Head title="Form Donatur" />
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Form Data Donatur</h2>
        </template>
        <section class="py-3 flex justify-center w-full">
            <div class="max-w-2xl">
                <form @submit.prevent="submit" class="w-full grid grid-cols-1 gap-7 bg-white px-4 py-3 rounded-lg shadow-md">
                    <div class="block">
                        <InputLabel value="Nama Donatur" />
                        <TextInput type="text" id="nama" v-model="AddForm.nama" />
                        <InputError :message="AddForm.errors.nama"  />
                    </div>
                    <div class="block">
                        <InputLabel value="alamat Donatur" />
                        <TextInput type="text" v-model="AddForm.alamat"/>
                        <InputError :message="AddForm.errors.alamat" />
                    </div>
                    <div class="block">
                        <InputLabel value="No. Telpon" />
                        <TextInput type="text" v-model="AddForm.no_telpon" />
                        <InputError :message="AddForm.errors.no_telpon" />
                    </div>
                    <div class="col-span-2">
                        <PrimaryButton type="submit" class="w-full text-center">Simpan</PrimaryButton>
                    </div>
                </form>
            </div>
        </section>

    </AuthenticatedLayout>
</template>
