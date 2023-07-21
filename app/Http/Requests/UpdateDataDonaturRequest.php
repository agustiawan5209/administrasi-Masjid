<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDataDonaturRequest extends FormRequest
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

            'slug' => 'required|exists:data_donaturs,id',
            'donatur_id' => 'required|exists:donaturs,id',
            'nama_donatur' => 'required|string|max:100',
            'jenis' => 'required|string|max:100',
            'jumlah' => 'required|string|max:50',
            'bukti' => 'nullable|image|max:1020',
            'tanggal' => 'required|date',
            'ket' => 'required|string',
        ];
    }
}
