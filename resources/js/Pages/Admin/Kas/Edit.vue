<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const props  = defineProps({
    kas :{
        type:Object,
        default:()=>({})
    }
})
const AddForm = useForm({
   kode: props.kas.kode,
   tanggal: props.kas.tanggal,
   kas_masuk: props.kas.kas_masuk,
   ket_kas_masuk: props.kas.ket_kas_masuk,
   kas_keluar: props.kas.kas_keluar,
   ket_kas_keluar: props.kas.ket_kas_keluar,
   total_kas: props.kas.total_kas,
})

function submit() {
    AddForm.put(route('KasMasjid.update', {slug:props.kas.id}));
}
</script>

<template>
    <AuthenticatedLayout>

        <Head title="Edit KasMasjid" />
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Data Kas Masjid  {{ kas.kode }} </h2>
        </template>
        <section class="py-3 flex justify-center w-full">
            <div class="max-w-2xl">
                <form @submit.prevent="submit" class="w-full grid grid-cols-2 gap-7 bg-white px-4 py-3 rounded-lg shadow-md">
                    <div class="block">
                        <InputLabel value="Tanggal" />
                        <TextInput type="date" v-model="AddForm.nama" placeholder="18/19/2023" />
                        <InputError :message="AddForm.errors.nama"  />
                    </div>
                    <div class="block">
                        <InputLabel value="Kas Masuk" />
                        <TextInput type="text" v-model="AddForm.kas_masuk"/>
                        <InputError :message="AddForm.errors.kas_masuk" />
                    </div>
                    <div class="block">
                        <InputLabel value="Keterangan Kas Masuk" />
                        <TextInput type="text" v-model="AddForm.ket_kas_masuk" />
                        <InputError :message="AddForm.errors.ket_kas_masuk" />
                    </div>
                    <div class="block">
                        <InputLabel value="Kas Keluar" />
                        <TextInput type="text" v-model="AddForm.kas_keluar"/>
                        <InputError :message="AddForm.errors.kas_keluar" />
                    </div>
                    <div class="block">
                        <InputLabel value="Keterangan Kas Masuk" />
                        <TextInput type="text" v-model="AddForm.ket_kas_keluar" />
                        <InputError :message="AddForm.errors.ket_kas_keluar" />
                    </div>
                    <div class="block">
                        <InputLabel value="Total Kas" />
                        <TextInput type="text" v-model="AddForm.total_kas" readonly/>
                        <InputError :message="AddForm.errors.total_kas" />
                    </div>
                    <div class="col-span-2">
                        <PrimaryButton type="submit" class="w-full text-center">Simpan</PrimaryButton>
                    </div>
                </form>
            </div>
        </section>

    </AuthenticatedLayout>
</template>
