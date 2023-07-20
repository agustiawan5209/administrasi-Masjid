<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJadwalKegiatanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id'=> 'required|exists:jadwal_kegiatans,id',
            'tanggal'=> 'required|date',
            'waktu'=> 'required|string',
            'kegiatan'=> 'required|string',
            'tempat'=> 'required|string',
            'ket'=> 'nullable|string|max:100',
            'penanggung_jawab'=> 'required',
        ];
    }
}
