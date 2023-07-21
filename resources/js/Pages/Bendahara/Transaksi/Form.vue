<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { ref } from 'vue';

const props = defineProps({
    kas: {
        type: Object,
        default: () => ({})
    },
    kode: String,
})
const AddForm = useForm({
    kode: props.kode,
    tanggal: '',
    kas_masuk: 0,
    ket_kas_masuk: '',
    kas_keluar: 0,
    ket_kas_keluar: '',
    total_kas: 0,
})

function submit() {
    AddForm.post(route('KasMasjid.store'));
}
const TotalKas = ref(null);
function kasTotal() {
    AddForm.total_kas = AddForm.kas_masuk - AddForm.kas_keluar;
    TotalKas.value = rupiah( AddForm.kas_masuk - AddForm.kas_keluar)
}
const rupiah = (number) => {
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR"
    }).format(number);
}
</script>

<template>
    <AuthenticatedLayout>

        <Head title="Tambah KasMasjid" />
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Form Tambah Data Kas Masjid </h2>
        </template>
        <section class="py-3 flex justify-center w-full">
            <div class="max-w-2xl">
                <form @submit.prevent="submit" class="w-full grid grid-cols-2 gap-7 ">
                    <div class="block col-span-2 bg-white px-4 py-3 rounded-lg shadow-md">
                        <InputLabel value="Tanggal" />
                        <TextInput type="date" v-model="AddForm.tanggal" :model-value="AddForm.tanggal" />
                        <InputError :message="AddForm.errors.tanggal" />
                    </div>
                    <div class="col-span-2 flex flex-wrap gap-5">
                        <div class=" flex flex-col gap-4 bg-white px-4 py-3 rounded-lg shadow-md">
                            <div class="block">
                                <InputLabel value="Kas Masuk" />
                                <TextInput type="number" v-model="AddForm.kas_masuk" @input="kasTotal"
                                    :model-value="AddForm.kas_masuk" />
                                <InputError :message="AddForm.errors.kas_masuk" />
                            </div>
                            <div class="block">
                                <InputLabel value="Keterangan Kas Masuk" />
                                <TextInput type="text" v-model="AddForm.ket_kas_masuk" />
                                <InputError :message="AddForm.errors.ket_kas_masuk" />
                            </div>
                        </div>
                        <div class=" flex flex-col gap-4 bg-white px-4 py-3 rounded-lg shadow-md">
                            <div class="block">
                                <InputLabel value="Kas Keluar" />
                                <TextInput type="number" v-model="AddForm.kas_keluar" @input="kasTotal"
                                    :model-value="AddForm.kas_keluar" />
                                <InputError :message="AddForm.errors.kas_keluar" />
                            </div>
                            <div class="block">
                                <InputLabel value="Keterangan Kas Masuk" />
                                <TextInput type="text" v-model="AddForm.ket_kas_keluar" />
                                <InputError :message="AddForm.errors.ket_kas_keluar" />
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row items-center gap-4 col-span-2 bg-white px-4 py-3 rounded-lg shadow-md ">
                        <InputLabel value="Total Kas" />
                        <div class="w-3/4">
                            <TextInput type="text" v-model="TotalKas" readonly class="border-0" />
                            <InputError :message="AddForm.errors.total_kas" />
                        </div>
                    </div>
                    <div class="col-span-2 bg-white px-4 py-3 rounded-lg shadow-md">
                        <PrimaryButton type="submit" class="w-full text-center justify-center">Simpan</PrimaryButton>
                    </div>
                </form>
            </div>
        </section>

    </AuthenticatedLayout>
</template>
