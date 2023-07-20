<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import Modal from '@/Components/Modal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'

const props = defineProps({
    struktur: {
        type:Object,
        default:()=>({}),
    }
})
const ModalVar = ref(false);
const Form = useForm({
    gambar: null,
    nama: 'Struktur Organisasi Masjid Ismul A’zham',
})

function showModal() {
    ModalVar.value = true;
}
function closeModal(){
    ModalVar.value=false;
    Form.reset('gambar')
}
const UrlFile = ref(null);

function fileSelected(e) {
    Form.gambar = e.target.files[0];
    UrlFile.value = URL.createObjectURL(e.target.files[0])
}
function submit(){
    Form.post(route('Struktur.store'), {
        onSuccess:()=>{
            Form.reset()
            ModalVar.value = false;
        }
    });
}
</script>

<template>
    <Head title="Struktur Organisasi" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Struktur Organisasi</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <PrimaryButton @click="showModal" v-if="struktur == null">Tambah</PrimaryButton>
                    <PrimaryButton @click="showModal" v-else>Ganti</PrimaryButton>
                    <div class="w-full bg-red-300 h-screen">
                        <img :src="struktur.path_gambar" alt="">
                    </div>
                </div>
            </div>
        </div>
        <Modal :show="ModalVar">

            <div class="flex flex-col items-center justify-center w-full py-4">
                <div class="max-w-md">
                    <label for="dropzone-file" v-if="Form.gambar == null"
                        class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                            </svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Masukan
                                    Gambar</span></p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                        </div>
                        <input id="dropzone-file" type="file" @input="fileSelected($event)" class="hidden" />
                    </label>
                    <img v-else :src="UrlFile" alt="">
                    <InputError :message="Form.errors.gambar" />

                </div>
                <div class=" bg-gray-100 px-2 py-4">
                    <InputLabel value="Nama"/>
                    <TextInput v-model="Form.nama" />
                    <InputError :message="Form.errors.nama" />
                </div>
                <div class="block">
                    <PrimaryButton @click="submit()">Simpan</PrimaryButton>
                    <PrimaryButton @click="closeModal" class="bg-red-500 hover:bg-red-600">Batal</PrimaryButton>
                </div>
            </div>

        </Modal>
    </AuthenticatedLayout>
</template>
