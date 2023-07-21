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
    SearchForm.get(route('KasMasjid.index', {
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

// Delete
const FormDelete = useForm({
    slug: null,
});
function deleteJadwal() {
    FormDelete.delete(route('KasMasjid.delete'), {
        onSuccess: () => {
            modalDelete.value = false;
            FormDelete.reset()
        },
    })
}
const rupiah = (number) => {
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR"
    }).format(number);
}

const FilterDateVar = ref(false)
const FormTanggal = useForm({
    max_date: '',
    min_date: '',
})
const VarBulan = ref('');
const MontForm = useForm({})
watch(VarBulan, (value) => {
    MontForm.get(route('KasMasjid.index',{month:value}),{
        preserveState:true,
    })
})
const Bulan = [
    { no: '01', bulan: 'Januari' },
    { no: '02', bulan: 'Februari' },
    { no: '03', bulan: 'Maret' },
    { no: '04', bulan: 'April' },
    { no: '05', bulan: 'Mei' },
    { no: '06', bulan: 'Juni' },
    { no: '07', bulan: 'Juli' },
    { no: '08', bulan: 'Agustus' },
    { no: '09', bulan: 'September' },
    { no: '10', bulan: 'Oktober' },
    { no: '11', bulan: 'November' },
    { no: '12', bulan: 'Desember' },
];

function CariTanggal() {
    FormTanggal.get(route("KasMasjid.index"), {
        preserveState: true,
        preserveScroll: true,
    })
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
                            <div class="w-full">
                                <h6>Total Kas : <span>{{ rupiah(total_saldo) }}</span></h6>
                            </div>
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
                                        <input type="text" id="simple-search" v-model="search" autofocus
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 "
                                            placeholder="Search" required="">
                                    </div>
                                </form>
                            </div>
                            <div
                                class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                                <Link :href="route('KasMasjid.create')">
                                <PrimaryButton>Tambah</PrimaryButton>
                                </Link>
                                <div class="flex items-center space-x-3 w-full md:w-auto">
                                    <PrimaryButton class="capitalize" @click="FilterDateVar = !FilterDateVar">Filter <svg
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6 transition-all"
                                            :class="FilterDateVar ? 'rotate-90' : 'rotate-0'">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                        </svg>
                                    </PrimaryButton>

                                </div>
                            </div>
                        </div>
                        <div v-show="FilterDateVar"
                            class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
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
                                        <PrimaryButton type="button" @click="CariTanggal">Cari</PrimaryButton>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                                    <tr>
                                        <th scope="col" class="px-4 py-3 border">Tanggal</th>
                                        <th scope="col" class="px-4 py-3 border">Kode</th>
                                        <th scope="col" class="px-4 py-3 border">Kas Masuk</th>
                                        <th scope="col" class="px-4 py-3 border text-xs">Keterangan Kas Masuk</th>
                                        <th scope="col" class="px-4 py-3 border">Kas Keluar</th>
                                        <th scope="col" class="px-4 py-3 border text-xs">Keterangan Kas Keluar</th>
                                        <th scope="col" class="px-4 py-3 border">Total Kas</th>
                                        <th scope="col" class="px-4 py-3 border">
                                            <select v-model="VarBulan"
                                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm placeholder:text-gray-300 w-full block text-sm text-gray-600">
                                                <option value="">--Pilih Bulan--</option>
                                                <option v-for="M in Bulan" :value="M.no">{{ M.bulan }}</option>
                                            </select>
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in kas.data" class="border-b ">
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
                                        <td class="px-2 py-1 border flex items-center justify-start">
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
                                                        :href="route('KasMasjid.edit', { nama: item.nama, slug: item.id, alamat: item.alamat, })">
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
                            </table>
                        </div>
                        <Pagination :links="kas.links" />
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
    </AuthenticatedLayout>
</template>
