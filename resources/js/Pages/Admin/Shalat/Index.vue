<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { defineProps, ref, watch } from 'vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import Modal from '@/Components/Modal.vue';
import FlashMessage from '@/Components/FlashMessage.vue';

const props = defineProps({
    jadwal: {
        type: Object,
        default: () => ({}),
    },
    search: String,
})

// Search Form
const SearchForm = useForm({});
const search = ref(props.search);

watch(search, (value) => {
    SearchForm.get(route('JadwalShalat.index', {
        search: value,
    }));
})

// Modal
const modalDelete = ref(false);
const FormDelete = useForm({
    slug: null,
});
function showModaldelete(param) {
    modalDelete.value = true;
    FormDelete.slug = param;
}
function closeModal() {
    modalDelete.value = false;
    FormDelete.slug = null;
}

function deleteJadwal() {
    FormDelete.delete(route('JadwalShalat.delete'), {
        onSuccess: () => {
            modalDelete.value = false;
            FormDelete.reset()
        }
    })
}
const Jenis= ref('shalat_wajib');

watch(Jenis, (value)=>{
    SearchForm.get(route('JadwalShalat.index',{jenis:value}),{
        preserveState:true,
        preserveScroll:true,
    })
})
</script>

<template>
    <Head title="JadwalShalat" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Jadwal Shalat</h2>
            <FlashMessage />
        </template>

        <div class="py-4">
            <section class="bg-transparent px-3 sm:px-5">

                <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                    <!-- Start coding here -->
                    <div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden">
                        <div
                            class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                            <div class="w-full md:w-1/2">
                                <form class="flex items-center">
                                    <label for="simple-search" class="sr-only">Search</label>
                                    <div class="relative w-full">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor"
                                                viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <input type="text" id="simple-search" v-model="search"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 "
                                            placeholder="Search" required="">
                                    </div>
                                </form>
                            </div>
                            <div
                                class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                                <Link :href="route('JadwalShalat.create')">
                                <PrimaryButton>Tambah</PrimaryButton>
                                </Link>
                                <div class="flex items-center space-x-3 w-full md:w-auto">

                                </div>
                            </div>
                        </div>

                        <ul
                            class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600">
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                <div class="flex items-center pl-3">
                                    <input id="shalat_wajib" v-model="Jenis" type="radio" value="shalat_wajib" name="list-radio"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                    <label for="shalat_wajib"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900">Shalat Wajib</label>
                                </div>
                            </li>
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                <div class="flex items-center pl-3">
                                    <input id="jumat" v-model="Jenis" type="radio" value="jumat" name="list-radio"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                    <label for="jumat"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900">Shalat Jum'at</label>
                                </div>
                            </li>
                        </ul>

                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                                    <tr class="bg-gray-400">
                                        <th scope="col" class="px-4 py-3 border">No.</th>
                                        <th scope="col" class="px-4 py-3 border">Tanggal</th>
                                        <th scope="col" class="px-4 py-3 border">Hari</th>
                                        <th scope="col" class="px-4 py-3 border">Jam</th>
                                        <th scope="col" class="px-4 py-3 border">Waktu</th>
                                        <th scope="col" class="px-4 py-3 border" v-if="Jenis == 'jumat'">Muadzin</th>
                                        <th scope="col" class="px-4 py-3 border" v-if="Jenis == 'jumat'">Khotbah</th>
                                        <th scope="col" class="px-4 py-3 border" v-if="Jenis == 'jumat'">Imam</th>
                                        <th scope="col" class="px-4 py-3 border">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody v-if="jadwal.data.length > 0 || Jenis !== null">
                                    <tr v-for="(item, index) in jadwal.data" class="border-b ">
                                        <th class="border text-center">{{ (jadwal.current_page - 1) * jadwal.per_page +
                                            index + 1 }}.</th>
                                        <td class="px-4 py-3 border">{{ item.tanggal }}</td>
                                        <td class="px-4 py-3 border">{{ item.hari }}</td>
                                        <td class="px-4 py-3 border">{{ item.jam }}</td>
                                        <td class="px-4 py-3 border">{{ item.waktu }}</td>
                                        <td class="px-4 py-3 border" v-if="Jenis == 'jumat'">{{ item.muadzin }}</td>
                                        <td class="px-4 py-3 border" v-if="Jenis == 'jumat'">{{ item.khotbah }}</td>
                                        <td class="px-4 py-3 border" v-if="Jenis == 'jumat'">{{ item.imam }}</td>
                                        <td class="px-4 py-3 border flex items-center justify-start">
                                            <Dropdown align="top" width="48">
                                                <template #trigger>
                                                    <span class="inline-flex rounded-md">
                                                        <button type="button"
                                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-red-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                                viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                            </svg>
                                                        </button>
                                                    </span>
                                                </template>

                                                <template #content>
                                                    <DropdownLink
                                                        class="bg-green-500 hover:bg-green-600 active:bg-green-400 text-white"
                                                        :href="route('JadwalShalat.edit', { waktu: item.waktu, slug: item.id, kegiatan: item.kegiatan, })">
                                                        Edit </DropdownLink>
                                                    <PrimaryButton type="button"
                                                        class="bg-error text-white hover:bg-red-600 active:bg-red-400 w-full block"
                                                        @click="showModaldelete(item.id)">
                                                        Hapus
                                                    </PrimaryButton>
                                                </template>
                                            </Dropdown>
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody v-else class="border-b-2">
                                    <tr>
                                        <td colspan="10" >
                                            <h1 class="text-center text-2xl font-medium py-4">Maaf Data Kosong</h1>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
                            aria-label="Table navigation">
                            <span class="text-sm font-normal text-gray-500">
                                Showing
                                <span class="font-semibold text-gray-900">1-10</span>
                                of
                                <span class="font-semibold text-gray-900">1000</span>
                            </span>
                            <ul class="inline-flex items-stretch -space-x-px">
                                <li>
                                    <a href="#"
                                        class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 ">
                                        <span class="sr-only">Previous</span>
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 ">1</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 ">2</a>
                                </li>
                                <li>
                                    <a href="#" aria-current="page"
                                        class="flex items-center justify-center text-sm z-10 py-2 px-3 leading-tight text-primary-600 bg-primary-50 border border-primary-300 hover:bg-primary-100 hover:text-primary-700">3</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 ">...</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 ">100</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 ">
                                        <span class="sr-only">Next</span>
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </section>
            <Modal :show="modalDelete" :maxWidth="'md'">
            <div class="max-w-full h-full flex justify-center items-center ">
                <div class="block bg-white rounded-lg py-5">
                    <h3 class="mb-4">Apakah Anda Yakin?</h3>
                    <div class="flex justify-around">
                        <PrimaryButton type="button" @click="deleteJadwal()"
                            class="bg-blue-500 hover:bg-blue-600 active:bg-blue-800">Ya
                        </PrimaryButton>
                        <PrimaryButton type="button" @click="closeModal()"
                            class="bg-error hover:bg-red-600 active:bg-red-800">Batal</PrimaryButton>
                    </div>
                </div>
            </div>
        </Modal>
    </div>
</AuthenticatedLayout></template>
