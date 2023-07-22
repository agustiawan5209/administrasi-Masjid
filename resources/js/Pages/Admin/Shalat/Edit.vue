<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    jadwal:{
        type:Object,
        default:()=>({})
    }
})

function mergeObjectsWithSameKey(objects) {
  return objects.reduce((result, currentObj) => {
    for (const key in currentObj) {
      if (currentObj.hasOwnProperty(key)) {
        if (result.hasOwnProperty(key)) {
          // Jika kunci sudah ada dalam objek hasil (result), maka gabungkan nilainya
          if (Array.isArray(result[key])) {
            // Jika nilai sekarang dan nilai yang sudah ada adalah array, gabungkan array tersebut
            result[key] = result[key].concat(currentObj[key]);
          } else if (typeof result[key] === 'object' && typeof currentObj[key] === 'object') {
            // Jika nilai sekarang dan nilai yang sudah ada adalah objek, rekursif panggil fungsi mergeObjectsWithSameKey
            result[key] = mergeObjectsWithSameKey([result[key], currentObj[key]]);
          } else {
            // Jika nilainya bukan array atau objek, maka gabungkan dalam array
            result[key] = [result[key], currentObj[key]];
          }
        } else {
          // Jika kunci belum ada dalam objek hasil (result), tambahkan kunci dan nilainya
          result[key] = currentObj[key];
        }
      }
    }
    return result;
  }, {});
}

const mergedObj = mergeObjectsWithSameKey(props.jadwal.data);
console.log(mergedObj['waktu']);


const WaktuShalat = ['Subuh', 'Dzuhur', 'Azhar', 'Maghrib', 'Isya',]
const JamShalat = ['04:00','12:00','15:00','18:00','19:00']
const AddForm = useForm({
    jenis: 'shalat_wajib',
    tanggal: mergedObj['tanggal'][0],
    hari: mergedObj['hari'][0],
    waktu_array: mergedObj['waktu'],
    jam_array: mergedObj['jam'],

})

function submit() {
    AddForm.post(route('JadwalShalat.update'));
}
const Hari = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu']

</script>

<template>
    <AuthenticatedLayout>

        <Head title="Form Kegiatan" />
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Form Jadwal Shalat Wajib</h2>
            <p>{{AddForm.errors}}</p>
        </template>
        <section class="py-3 container mx-auto">
            <div class="w-full">
                <form @submit.prevent="submit" class="w-full gap-7 bg-white px-4 py-3 rounded-lg shadow-md">

                    <div class="grid grid-cols-1" v-if="AddForm.jenis == 'shalat_wajib'">
                        <div class="block">
                            <InputLabel value="Tanggal Shalat" />
                            <TextInput type="date" v-model="AddForm.tanggal" />
                            <InputError :message="AddForm.errors.tanggal" />
                        </div>

                        <div class="block">
                            <InputLabel value="Hari" />
                            <select  v-model="AddForm.hari"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm placeholder:text-gray-300 w-full">
                                <option value="">---</option>
                                <option v-for="day in Hari" :value="day" class="capitalize">{{ day }}</option>
                            </select>
                            <InputError :message="AddForm.errors.hari" />
                        </div>
                        <div>
                            <div class="block mb-3 border-2 px-2 py-2 border-gray-700" v-for="(shalat,index) in WaktuShalat">
                                <div>
                                    <InputLabel :value="'Waktu Shalat ' + shalat" />
                                    <input type="text" v-model="AddForm.waktu_array[index]" :id="shalat" :name="shalat" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm placeholder:text-gray-300 w-full"  />
                                </div>
                                <div>
                                    <InputLabel :value="'Jam Shalat ' + shalat" />
                                    <input type="time" v-model="AddForm.jam_array[index]" :id="'jam' + shalat"
                                        :name="'jam' + shalat"  class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm placeholder:text-gray-300 w-full" />
                                </div>
                            </div>
                            <InputError :message="AddForm.errors.waktu" />
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
